<?php 
namespace App\Controllers;  
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\StudentModel;
use App\Models\LecturerModel;
use App\Controllers\BaseController;
  
class Profile extends BaseController
{
    public function index()
    {

        $data=[
            'title' => 'Profile',

        ];
        // dd($data);
        return view('profile/profile', $data);
    }

    public function edit($id)
    {
        $usermodel = new UserModel();
        $user = $usermodel->find($id);

        $data=[
            'title' => 'Profile | LS',
            'user' => $user
        ];

        // d($data);
        return view('profile/profile', $data);
    }

    public function update($id)
    {
        $usermodel = new UserModel();
        $studentmodel = new StudentModel();
        $lecturermodel = new LecturerModel();
        $password = $this->request->getVar('password');
    
        // Password policy: 8 characters minimum length, 1 lower case, 1 upper case, 1 number, 1 special character, no spaces
        $passwordPolicy = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])(?!.*\s).{8,}$/';
    
        if (!preg_match($passwordPolicy, $password)) {
            return redirect()->to('/profile/edit/'.$id)
                             ->withInput()
                             ->with('error', 'Password does not meet the required policy');
        }
    
        $data = [
            'fullname' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
    
        // Fetch the user's role from the database
        $user = $usermodel->find($id);
        $role = $user['role'];
    
        if ($role == 'Student') {
            $data['studentid'] = $this->request->getVar('studentid');
            $studentData = [
                'sname' => $this->request->getVar('fullname'),
                'semail' => $this->request->getVar('email'),
                'studentid' => $this->request->getVar('studentid'),
            ];
            $studentmodel->update($id, $studentData);
        } elseif ($role == 'Lecturer') {
            $lecturerData = [
                'lname' => $this->request->getVar('fullname'),
                'lemail' => $this->request->getVar('email'),
            ];
            $lecturermodel->update($id, $lecturerData);
        }
    
        $usermodel->update($id, $data);
    
        return redirect()->to('/profile/edit/'.$id)->with('message', 'Successfully updated profile');
    }
}