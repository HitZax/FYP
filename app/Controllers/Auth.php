<?php 
namespace App\Controllers;  
use Config\Services;
use App\Models\ChatModel;
use App\Models\UserModel;
use App\Models\InternModel;
use CodeIgniter\Controller;
use App\Models\LogbookModel;
use App\Models\ProgramModel;
use App\Models\StudentModel;
use App\Models\AuditLogModel;
use App\Models\LecturerModel;
use App\Models\TwoFACodeModel;
use App\Models\InviteCodeModel;
use App\Models\ActiveSessionModel;

class Auth extends Controller
{
    public function __construct()
    {
        $this->logbookModel = new LogbookModel();
        $this->auditLogModel = new AuditLogModel();
        $this->userModel = new UserModel();
    }

    // Display login page
    public function index()
    {
        return view('auth/login');
    } 

    // Handle login attempt
    public function attemptLogin()
    {
        // Clean up expired sessions
        $this->cleanUpExpiredSessions();

        $session = session();
        $userModel = new UserModel();
        $activeSessionModel = new ActiveSessionModel();
        $auth = $this->request->getVar('auth');
        $password = $this->request->getVar('password');
        $recaptchaResponse = $this->request->getVar('g-recaptcha-response');
    
        // Verify reCAPTCHA
        $secretKey = '6Lea9pAqAAAAAOAiaPzioYZHqO65YVNeG98hN7RE';
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $response = file_get_contents($recaptchaUrl . '?secret=' . $secretKey . '&response=' . $recaptchaResponse);
        $responseKeys = json_decode($response, true);
    
        if (intval($responseKeys["success"]) !== 1) {
            $session->setFlashdata('msg', 'reCAPTCHA verification failed. Please try again.');
            $this->logAudit($auth, 'Login', 'Failed', 1);
            return redirect()->to('/login');
        }
    
        $data = $userModel->where('email', $auth)->orWhere('studentid', $auth)->first();
    
        if ($data) {
            if ($data['role'] !== 'Admin' && $data['status'] !== 'Active') {
                $session->setFlashdata('msg', 'Your account is inactive. Please contact support.');
                $this->logAudit($data['id'], 'Login', 'Failed', 1);
                return redirect()->to('/login');
            }
    
            // Check for existing active session
            $existingSession = $activeSessionModel->where('user_id', $data['id'])->first();
            if ($existingSession) {
                $session->setFlashdata('msg', 'You are already logged in on another device.');
                $this->logAudit($data['id'], 'Login', 'Failed', 1);
                return redirect()->to('/login');
            }
    
            $pass = $data['password'];
            if (password_verify($password, $pass)) {
                // Check if 2FA is required
                $last2FA = $data['last2FA'];
                if (is_null($last2FA) || (time() - strtotime($last2FA)) > 30 * 24 * 60 * 60) {
                    $this->send2FACode($data['id']);
                    $session->set('2fa_user_id', $data['id']);
                    return redirect()->to('/twofa');
                }
    
                $session_data = [
                    'id' => $data['id'],
                    'fullname' => $data['fullname'],
                    'studentid' => $data['studentid'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                    'logged_in' => TRUE,
                ];
                $session->set($session_data);
    
                // Save active session
                $activeSessionModel->save([
                    'user_id' => $data['id'],
                    'session_id' => session_id(),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
    
                $this->logAudit($data['id'], 'Login', 'Success', 1);
    
                if ($data['role'] == 'Admin') {
                    return redirect()->to('/admin/dashboard');
                } else {
                    return redirect()->to('/dashboard');
                }
            } else {
                $session->setFlashdata('msg', 'Invalid Password');
                $this->logAudit($data['id'], 'Login', 'Failed', 1);
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Invalid Email or Student ID.');
            $this->logAudit($auth, 'Login', 'Failed', 1);
            return redirect()->to('/login');
        }
    }
    
    // Display 2FA page
    public function twoFA()
    {
        return view('auth/twoFA');
    } 

    // Create 6 digit code
    private function generate2FACode()
    {
        return rand(100000, 999999);
    }

    // verify 2FA code
    public function verify2FA()
    {
        $session = session();
        $twoFACodeModel = new TwoFACodeModel();
        $userId = $session->get('2fa_user_id');
        $inputCode = $this->request->getVar('twoFACode');

        $codeData = $twoFACodeModel->where('user_id', $userId)
                                ->where('expires_at >=', date('Y-m-d H:i:s'))
                                ->orderBy('created_at', 'DESC')
                                ->first();

        if ($codeData && $codeData['code'] === $inputCode) {
            // Update last2FA
            $this->userModel->update($userId, ['last2FA' => date('Y-m-d H:i:s')]);

            // Log the user in
            $userData = $this->userModel->find($userId);
            $session_data = [
                'id' => $userData['id'],
                'fullname' => $userData['fullname'],
                'studentid' => $userData['studentid'],
                'email' => $userData['email'],
                'role' => $userData['role'],
                'logged_in' => TRUE,
            ];
            $session->set($session_data);

            // Save active session
            $activeSessionModel = new ActiveSessionModel();
            $activeSessionModel->save([
                'user_id' => $userData['id'],
                'session_id' => session_id(),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $this->logAudit($userData['id'], 'Login', 'Success', 1);

            if ($userData['role'] == 'Admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/dashboard');
            }
        } else {
            $session->setFlashdata('msg', 'Invalid or expired 2FA code.');
            return redirect()->to('/twofa');
        }
    }

    // Send 2FA code to user and create record in database
    private function send2FACode($userId)
    {
        $twoFACodeModel = new TwoFACodeModel();
        $code = $this->generate2FACode();
        $expiresAt = date('Y-m-d H:i:s', time() + 5 * 60); // 5 minutes from now

        $twoFACodeModel->save([
            'user_id' => $userId,
            'code' => $code,
            'expires_at' => $expiresAt
        ]);

        $user = $this->userModel->find($userId);
        $userEmail = $user['email'];
        $userFullName = $user['fullname'];

        // Load the email library
        $email = \Config\Services::email();

        // Set email configuration
        $email->setFrom('MS_LEvWMW@trial-351ndgw0kox4zqx8.mlsender.net', 'Secured OLS');
        $email->setTo($userEmail);
        $email->setSubject('2FA Code');
        $email->setMailType('html');
        $email->setMessage("
            <p>Dear $userFullName,</p>
            <p>Your Two-Factor Authentication (2FA) code for accessing the Online Logbook System is:</p>
            <h1><strong>$code</strong></h1>
            <p>Please use this code to complete your login process. This code will expire in <strong>5 minutes</strong>.</p>
            <p>Thank you,<br>Online Logbook System Team</p>
        ");

        // Send the email
        if ($email->send()) {
            // Email sent successfully
        } else {
            // Email failed to send
            log_message('error', 'Failed to send 2FA code email to ' . $userEmail);
        }
    }

    // Resend 2FA code
    public function resend2FACode()
    {
        $session = session();
        $userId = $session->get('2fa_user_id');

        if ($userId) {
            $this->send2FACode($userId);
            $session->setFlashdata('msg', 'A new 2FA code has been sent to your email.');
        } else {
            $session->setFlashdata('msg', 'Unable to resend 2FA code. Please try again.');
        }

        return redirect()->to('/twofa');
    }

    // Handle logout
    public function logout()
    {
        $session = session();
        $activeSessionModel = new ActiveSessionModel();
    
        // Remove active session
        $activeSessionModel->where('session_id', session_id())->delete();
    
        $this->logAudit($session->get('id'), 'Logout', 'Success', 0);

        $session->destroy();
        return redirect()->to('/login');
    }

    // Log audit data
    private function logAudit($userId, $action, $status)
    {
        // Get the last attempt number for the user
        $lastAttempt = $this->auditLogModel->where('user_id', $userId)
                                           ->orderBy('timestamp', 'DESC')
                                           ->first();
        
        if ($status === 'Success') {
            $attemptNumber = 0;
        } else {
            $attemptNumber = $lastAttempt ? $lastAttempt['attempt_number'] + 1 : 1;
        }
    
        $auditData = [
            'user_id' => $userId,
            'action' => $action,
            'status' => $status,
            'attempt_number' => $attemptNumber,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent(),
            'timestamp' => date('Y-m-d H:i:s')
        ];
        $this->auditLogModel->save($auditData);
    
        // Check for brute force attempts
        $this->userModel->checkBruteForce($userId);
    }

    // Handle expired sessions
    public function cleanUpExpiredSessions()
    {
        $activeSessionModel = new ActiveSessionModel();
        $sessionExpiration = 900; // 15 minutes

        // Delete sessions that have expired
        $activeSessionModel->where('created_at <', date('Y-m-d H:i:s', time() - $sessionExpiration))->delete();
    }

    // Display registration page
    public function register()
    {
        helper(['form']);
        $programmodel = new ProgramModel();
        $program = $programmodel->findall();
        
        $data = [
            'program'=> $program
        ];

        return view('auth/register', $data);
    }

    // Handle student registration attempt
    public function attemptRegister()
    {
        $session = session();
        $usermodel = new UserModel();
        $data = [
            'fullname'      => $this->request->getVar('name'),
            'email'         => $this->request->getVar('email'),
            'password'      => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'studentid'     => $this->request->getVar('studentid'),
            'role'          => "Student"
        ];
        $usermodel->save($data);

        $id = $usermodel->getInsertID();
        // dd($id);

        $studentmodel = new StudentModel();
        $data1 = [
            'studentid' => $this->request->getVar('studentid'),
            'sname'     => $this->request->getVar('name'),
            'sprogram'  => $this->request->getVar('program'),
            'id'        => $id
        ];
        if (!$studentmodel->insert($data1)) {
            // Log the error
            $errors = $studentmodel->errors();
            dd($errors);
        }

        $sid = $studentmodel->getInsertID();
        // dd($sid);

        $data2 = [
            'lbcreated' => date('Y-m-d'),
            'sid'       => $sid
        ];
        $this->logbookModel->save($data2);

        $chatmodel = new ChatModel();
        $data3 = [
            'sid' => $sid,
        ];
        $chatmodel->save($data3);

        $internmodel = new InternModel();
        $data4 = [
            'id' => $id,
            'sid' => $sid
        ];
        $internmodel->insert($data4);

        $session->setFlashdata('msg', 'Successfully Registered');
        return redirect()->to('/admin/dashboard');
    }

    // Display lecturer registration page
    public function registerlect($invitecode = null)
    {
        $data=[
            'title'=>'Register Lecturer',
            'invitecode' => $invitecode
        ];
        return view('auth/registerlect', $data);
    }

    // Handle lecturer registration attempt
    public function attemptRegisterlect()
    {
        $session = session();
        $usermodel = new UserModel();
        $data = [
            'fullname'      => $this->request->getVar('name'),
            'email'         => $this->request->getVar('email'),
            'password'      => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'studentid'     => NULL,
            'role' => "Lecturer"
        ];
        $usermodel->save($data);

        $id = $usermodel->getInsertID();

        $lecturermodel = new LecturerModel();
        $data1=[
            'lname' => $this->request->getVar('name'),
            'lemail' => $this->request->getVar('email'),
            'lroom' => $this->request->getVar('room'),
            'id' => $id,
        ];
        $lecturermodel->save($data1);

        $internmodel = new InternModel();
        $data2 = [
            'id' => $id,
            'sid' => NULL
        ];
        $internmodel->insert($data2);


        $session->setFlashdata('msg', 'Successfully Registered');
        return redirect()->to('/admin/dashboard');
    }

    // Display password reset page
    public function password()
    {
        return view('auth/password');
    }

    public function sendResetLink()
    {
        $email = $this->request->getVar('email');
        $user = $this->userModel->where('email', $email)->first();

        if ($user) {
            $token = bin2hex(random_bytes(50));
            $expiresAt = date('Y-m-d H:i:s', time() + 900); // 15 Minutes
            // Save the token and expiration time in the password_resets table
            $db = \Config\Database::connect();
            $db->table('password_resets')->insert([
                'user_id' => $user['id'],
                'token' => $token,
                'expires_at' => $expiresAt
            ]);
        
            // Send the reset link to the user's email
            $resetLink = base_url("auth/resetPassword/$token");
            $emailService = \Config\Services::email();
            $emailService->setFrom('MS_LEvWMW@trial-351ndgw0kox4zqx8.mlsender.net', 'Secured OLS');
            $emailService->setTo($email);
            $emailService->setSubject('Password Reset Request');
            $emailService->setMessage("
                <html>
                <head>
                    <title>Password Reset Request</title>
                </head>
                <body>
                    <p>Dear {$user['fullname']},</p>
                    <p>We received a request to reset your password. Click the link below to reset your password:</p>
                    <p><a href='$resetLink'>Click here to reset your password</a></p>
                    <p>If you did not request a password reset, please ignore this email.</p>
                    <p>Thank you,<br>Online Logbook System Team</p>
                </body>
                </html>
            ");
            $emailService->setMailType('html'); // Ensure the email is sent as HTML
        
            if ($emailService->send()) {
                return redirect()->to('/password')->with('msg', 'Password reset link has been sent to your email.');
            } else {
                return redirect()->to('/password')->with('msg', 'Failed to send password reset link. Please try again.');
            }
        } else {
            return redirect()->to('/password')->with('msg', 'Email address not found.');
        }
    }

    public function resetPassword($token)
    {
        $db = \Config\Database::connect();
        $resetData = $db->table('password_resets')
                        ->where('token', $token)
                        ->where('expires_at >=', date('Y-m-d H:i:s'))
                        ->get()
                        ->getRowArray();

        if ($resetData) {
            // Reset the user's password to '123'
            $this->userModel->update($resetData['user_id'], [
                'password' => password_hash('123', PASSWORD_DEFAULT)
            ]);

            // Delete the reset token
            $db->table('password_resets')->where('id', $resetData['id'])->delete();

            return redirect()->to('/login')->with('msg', 'Your password has been reset to "123". Please log in and change your password.');
        } else {
            return redirect()->to('/password')->with('msg', 'Invalid or expired reset token.');
        }
    }
}