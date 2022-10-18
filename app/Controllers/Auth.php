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
        // dd($auth);
        // dd($password);
        $data = $userModel->where('email', $auth)->orWhere('studentid', $auth)->first();
        
        if($data)
        {
            $pass = $data['password'];
            // $data=[
            //     'pass' => $pass,
            //     'password' => $password,
            // ];
        //    dd($data);
            // $authenticatePassword = password_verify($password, $pass);
            if($pass == $password)
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
                return redirect()->to('/');
            }
        }
        else
        {
            $session->setFlashdata('msg', 'Email or Student ID not Found');
            return redirect()->to('/');
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
        d($data);

        return view('auth/register', $data);
    }

    public function attemptRegister()
    {
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]',
            'sprogram'      => 'required',
            'studentid'     => 'required|min_length[6]|max_length[20]|is_unique[users.studentid]',
        ];
          
        if($this->validate($rules))
        {
            $userModel = new UserModel();
            $data = [
                'fullname'     => $this->request->getVar('fullname'),
                'studentid' => $this->request->getVar('studentid'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'program' => $this->request->getVar('program'),
            ];
            // dd($data);
            $userModel->save($data);

            $studentmodel = new StudentModel();
            $data1=[
                'sname' => $this->request->getVar('fullname'),
                'studentid' => $this->request->getVar('studentid'),
                'sprogram' => $this->request->getVar('program'),
            ];

            $studentmodel->insert($data1);
            return redirect()->to('/login');
        }
        else
        {
            $data['validation'] = $this->validator;
            return view('auth/signup', $data);
        }

        
          
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}