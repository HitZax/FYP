<?php 
namespace App\Controllers;  
use Config\Services;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ProgramModel;
use App\Models\StudentModel;
  
class Auth extends Controller
{
    public function index()
    {
        // helper(['form']);
        return view('auth/login');
    } 
  
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
          
            // $authenticatePassword = password_verify($password, $pass);
            if($password == $pass)
            {
                $session_data = [
                    'id' => $data['id'],
                    'fullname' => $data['fullname'],
                    'studentid' => $data['studentid'],
                    'email' => $data['email'],
                    'logged_in' => TRUE
                ];
                $session->set($session_data);
                return redirect()->to('/student');
            }
            else
            {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        }
        else
        {
            $session->setFlashdata('msg', 'Email or Student ID not Found');
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
        ];
        $usermodel->save($data);

        $studentmodel = new StudentModel();
        $data1=[
            'studentid' => $this->request->getVar('studentid'),
            'sname' => $this->request->getVar('name'),
            'sprogram' => $this->request->getVar('program'),
        ];
        $studentmodel->save($data1);
        $session->setFlashdata('msg', 'Successfully Registered');
        return redirect()->to('/login');
           
    }

    public function registerlect()
    {
        $data=['title'=>'Register Lecturer'];
        return view('auth/registerlect', $data);
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
            'studentid'     => $this->request->getVar('studentid'),
            'program'       => $this->request->getVar('program'),
        ];
        $usermodel->save($data);
        $session->setFlashdata('msg', 'Successfully Registered');
        return redirect()->to('/login');
           
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}