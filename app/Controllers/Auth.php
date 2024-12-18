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

class Auth extends Controller
{
    public function __construct()
    {
        $this->logbookModel = new LogbookModel();
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
        $auth = $this->request->getVar('auth');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('email', $auth)->orWhere('studentid', $auth)->first();
        
        if($data)
        {
            $pass = $data['password'];
            if($password == $pass)
            {
                $session_data = [
                    'id' => $data['id'],
                    'fullname' => $data['fullname'],
                    'studentid' => $data['studentid'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                    'logged_in' => TRUE,
                ];
                $session->set($session_data);
                return redirect()->to('/dashboard');
            }
            else
            {
                $session->setFlashdata('msg', 'Invalid Password');
                return redirect()->to('/login');
            }
        }
        else
        {
            $session->setFlashdata('msg', 'Invalid Email or Student ID.');
            return redirect()->to('/login');
        }
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
            'password'      => $this->request->getVar('password'),
            'studentid'     => $this->request->getVar('studentid'),
            'program'       => $this->request->getVar('program'),
            'role' => "Student"
        ];
        $usermodel->save($data);

        $studentmodel = new StudentModel();
        $data1=[
            'studentid' => $this->request->getVar('studentid'),
            'sname' => $this->request->getVar('name'),
            'sprogram' => $this->request->getVar('program'),
        ];
        $studentmodel->save($data1);

        $sid = $studentmodel->getInsertID();

        $data2=[
            'lbcreated' => date('Y-m-d'),
            'sid'       => $sid
        ];
        $this->logbookModel->save($data2);

        $session->setFlashdata('msg', 'Successfully Registered');
        return redirect()->to('/login');
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
    public function registerlect($invitecode)
    {
        $invcodemodel = new InviteCodeModel();
        $checkcode = $invcodemodel->where('invcode',$invitecode)->first();

        if($checkcode)
        {
            $data=[
                'title'=>'Register Lecturer',
                'invitecode' => $invitecode
            ];
            return view('auth/registerlect', $data);
        }
        else
        {
            return redirect()->to('/login');
        }
    }

    // Handle lecturer registration attempt
    public function attemptRegisterlect()
    {
        $session = session();
        $usermodel = new UserModel();
        $data = [
            'fullname'      => $this->request->getVar('name'),
            'email'         => $this->request->getVar('email'),
            'password'      => $this->request->getVar('password'),
            'studentid'     => "-",
            'role' => "Lecturer"
        ];
        $usermodel->save($data);

        $lecturermodel = new LecturerModel();
        $data1=[
            'lname' => $this->request->getVar('name'),
            'lemail' => $this->request->getVar('email'),
            'lroom' => $this->request->getVar('room'),
            'invcode' => $this->request->getVar('invcode'),
        ];
        $lecturermodel->save($data1);

        $session->setFlashdata('msg', 'Successfully Registered');
        return redirect()->to('/login');
    }

    // Handle logout
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    // Display password reset page
    public function password()
    {
        return view('auth/password');
    } 
}