<?php 
namespace App\Controllers;  
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
}