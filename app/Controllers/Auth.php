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

    public function index()
    {
        return view('auth/login');
    } 
  
    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();
        $auth = $this->request->getVar('auth');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('email', $auth)->orWhere('studentid', $auth)->first();
        // $data = $userModel->login($auth);
        
        if($data)
        {
            $pass = $data['password'];
            
            // $pass = $data->password;
          
            // $authenticatePassword = password_verify($password, $pass);
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

    public function register()
    {
        helper(['form']);

        $programmodel = new ProgramModel();
        $program = $programmodel->findall();
        
        $data = [
            'program'=> $program
        ];
        // d($data);

        return view('auth/register', $data);
    }

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

        // $internid = $internmodel->getInsertID();

        // $data3=[
        //     'lbcreated' => date('Y-m-d'),
        //     'sid'       => $sid
        // ];
        // $this->internModel->save($data3);

        $session->setFlashdata('msg', 'Successfully Registered');
        return redirect()->to('/login');
           
    }

    
    public function invitecode()
    {
        $data=['title'=>'Register Lecturer'];
        return view('auth/invitecode', $data);
    }

    public function receiveInvCode()
    {
        $invitecode = $this->request->getVar('invcode');

        // dd($invitecode);
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
        
        // dd($invitecode);
    }

    public function registerlect($invitecode)
    {
        // $invitecode = $this->request->getVar('invitecode');

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

    //attempt register lecturer
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
        // dd($data1);
        $lecturermodel->save($data1);

        // dd($data,$data1);
        $session->setFlashdata('msg', 'Successfully Registered');
        return redirect()->to('/login');
           
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

        public function password()
    {
    
        return view('auth/password');
    } 
}