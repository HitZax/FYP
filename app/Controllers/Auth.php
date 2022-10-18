<?php 
namespace App\Controllers;  
use Config\Services;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\ProgramModel;
use App\Models\StudentModel;
  
class Auth extends Controller
{
    public function index()
    {
        helper(['form']);
        return view('auth/signin');
    } 
  
    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();
        $auth = $this->request->getVar('auth');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('email', $auth)->orWhere('studentid', $auth)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['fullname'],
                    'email' => $data['email'],
                    'studentid' => $data['studentid'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/student');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/login');
        }
    }

    public function register()
    {
        helper(['form']);

        $programmodel = new ProgramModel();
        $program = $programmodel->findall();
        
        $data = [
            'sprogram'=> $program
        ];
        d($data);

        return view('auth/signup', $data);
    }

    public function attemptRegister()
    {
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]',
            'studentid'     => 'required|min_length[6]|max_length[20]|is_unique[users.studentid]',
        ];
          
        if($this->validate($rules))
        {
            $userModel = new UserModel();
            $data = [
                'fullname'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'studentid' => $this->request->getVar('studentid'),
            ];
            // dd($data);
            $userModel->save($data);

            $studentmodel = new StudentModel();
            $data1=[
                'sname' => $this->request->getVar('name'),
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