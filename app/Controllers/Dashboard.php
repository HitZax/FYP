<?php 
namespace App\Controllers;  
use App\Models\UserModel;
use App\Models\InternModel;
use CodeIgniter\Controller;
use App\Models\StudentModel;
use App\Controllers\BaseController;
  
class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->internModel = new InternModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        if(session()->get('role')=="Student")

        {
        $internmodel = new InternModel();
        $intern = $internmodel->detail(session()->get('id'));

        //get current and end time
        $now = date("Y-m-d"); 
        $enddate = date("Y-m-d",strtotime($intern->enddate));

        if(empty($enddate)){

        }

        //count days
        $origin = date_create($now);
        $target = date_create($enddate);
        $interval = date_diff($origin, $target);
        $days = $interval->format('%a');
        
        //count weeks
        $daytoint = (int)$days/7;
        $week = intval($daytoint);

        $data=[
            'title' => 'Dashboard',
            'id'=> session()->get('id'),
            'name' => session()->get('fullname'),
            'email' => session()->get('email'),
            'studentid' => session()->get('studentid'),
            'sid' => session()->get('sid'),
            'intern' => $intern,
            'now' => $now,
            'endate' => $enddate,
            'days' => $days,
            'week' => $week
        ];
        // dd($data);
        return view('dashboard/dashboard', $data);
        }

        else

        {
            $data=[
                'title' => 'Dashboard Lecturer',
            ];

            

            return view('dashboard/dashboardlect', $data);
        }
        
    }

    public function intern()
    {
        // $sid = $this->studentModel->WHERE('studentid', session()->get('studentid'))->first();
        
        $data=[
            'title' => 'Intership Detail | OLS',
            // 'student' => $sid
        ];
        // dd($data);

        return view('dashboard/interndetail', $data);
    }

    public function storeintern($id)
    {
        $data=[
            'id' => $id,
            'startdate' => $this->request->getVar('startddate'),
            'enddate' => $this->request->getVar('enddate'),
            'location' => $this->request->getVar('location'),
            'svname' => $this->request->getVar('svname'),
            'svnum' => $this->request->getVar('svnum'),
        ];
        // dd($data);
        $this->internModel->insert($data);

        $user = $this->userModel->WHERE('id', $id)->first();

        $data1=[
            'id' => $id,
            'fullname' => $user['fullname'],
            'studentid' => $user['studentid'],
            'email' => $user['email'],
            'password' => $user['password'],
            'role' => $user['role'],
            'interndet' => '1'
        ];
        // dd($data1);
        $this->userModel->replace($data1);

 
        $session_data = [
            'id' => $user['id'],
            'fullname' => $user['fullname'],
            'studentid' => $user['studentid'],
            'email' => $user['email'],
            'role' => $user['role'],
            'logged_in' => TRUE,
     
        ];
        $session->set($session_data);
        return redirect()->to('/dashboard');
    }
    
}