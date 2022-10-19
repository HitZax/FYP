<?php 
namespace App\Controllers;  
use App\Models\UserModel;
use CodeIgniter\Controller;
  
class Profile extends BaseController
{
    public function index()
    {
        // $session = session();
        $data=[
            'title' => 'Profile',
            // 'name' => $this->session->get('name'),
            // 'email' => $this->session->get('email'),
            // 'studentid' => $this->session->get('studentid')
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

        $data=[
            'sid' => $id,
            'fullname' => $this->request->getVar('fullname'),
            'studentid' => $this->request->getVar('studentid'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];
        dd($data);
        $studentmodel->replace($data);

        return redirect()->to('/student')->with('message','update');
    }
}