<?php 
namespace App\Controllers;  
use Config\Services;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\LogbookModel;
use App\Models\ProgramModel;
use App\Models\StudentModel;
use App\Models\LecturerModel;
use App\Models\InviteCodeModel;
use App\Models\ChatModel;
use App\Models\InternModel;
use App\Models\ActiveSessionModel;
use App\Models\AuditLogModel;

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

    // Display invite code page
    public function invitecode()
    {
        $data=['title'=>'Register Lecturer'];
        return view('auth/invitecode', $data);
    }

    // Handle invite code submission
    public function receiveInvCode()
    {
        $invitecode = $this->request->getVar('invcode');
        $invcodemodel = new InviteCodeModel();
        $checkcode = $invcodemodel->where('invcode',$invitecode)->first();

        if($checkcode)
        {
            return redirect()->to('/register/lecturer/'.$invitecode);
        }
        else
        {
            return redirect()->to('/login');
        }
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
}