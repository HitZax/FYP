<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
  
class Dashboard extends BaseController
{
    public function index()
    {
        // $session = session();
        $data=[
            'title' => 'Dashboard',
            // 'name' => $this->session->get('name'),
            // 'email' => $this->session->get('email'),
            // 'studentid' => $this->session->get('studentid')
        ];
        // dd($data);
        return view('dashboard/dashboard', $data);
    }
}