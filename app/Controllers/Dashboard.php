<?php 
namespace App\Controllers;  
use App\Models\TaskModel;
use App\Models\UserModel;
use App\Models\InternModel;
use CodeIgniter\Controller;
use App\Models\LogbookModel;
use App\Models\StudentModel;
use App\Controllers\BaseController;
  
class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->internModel = new InternModel();
        $this->userModel = new UserModel();
        $this->taskModel = new TaskModel();
        $this->logbookModel = new LogbookModel();

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

    
        //count days
        $origin = date_create($now);
        $target = date_create($enddate);
        $interval = date_diff($origin, $target);
        $days = $interval->format('%a');
        
        //count weeks
        $daytoint = (int)($days/7-12)*-1;
        $week = intval($daytoint);

        //display task count and table
        $student = $this->studentModel->WHERE('studentid', session()->get('studentid'))->first();
        $logbook = $this->logbookModel->WHERE('sid', $student['sid'])->first();
        $lbid = $logbook['lbid'];
        $taskcount = $this->taskModel->counttask($lbid);
        $task = $this->taskModel->WHERE('lbid',$logbook['lbid'])->findAll();

        

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
            'week' => $week,
            'taskcount' => $taskcount,
            'task' => $task
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

    
    
}