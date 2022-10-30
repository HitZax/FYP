<?php 
namespace App\Controllers;  
use App\Models\InternModel;
use CodeIgniter\Controller;
  
class Dashboard extends BaseController
{
    public function index()
    {
        if(session()->get('role')=="Student")

        {
        $internmodel = new InternModel();
        $intern = $internmodel->detail(session()->get('id'));

        //get current and end time
        $now = date("Y-m-d"); 
        $enddate = date("Y-m-d",strtotime($intern->enddate));

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
            // 'endate' => $enddate,
            'days' => $days,
            'week' => $week
        ];
        d($data);
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
    
}