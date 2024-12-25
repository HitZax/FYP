<?php 
namespace App\Controllers;  

use App\Models\TaskModel;
use App\Models\UserModel;
use App\Models\InternModel;
use CodeIgniter\Controller;
use App\Models\LogbookModel;
use App\Models\StudentModel;
use App\Models\LecturerModel;
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
        $this->lecturerModel = new LecturerModel();
    }

    public function index()
    {
        $role = session()->get('role');
        $id = session()->get('id');
        $data = [
            'title' => 'Dashboard',
            'id' => $id,
            'name' => session()->get('fullname'),
            'email' => session()->get('email'),
            'studentid' => session()->get('studentid'),
            'sid' => session()->get('sid')
        ];
    
        $intern = $this->internModel->detail($id);
        
        // Get current and end time
        $now = date("Y-m-d"); 
        $startdate = $intern->startdate ? date("Y-m-d", strtotime($intern->startdate)) : null;
        $enddate = $intern->enddate ? date("Y-m-d", strtotime($intern->enddate)) : null;
        
        // Calculate days remaining
        $days = $enddate ? (strtotime($enddate) - strtotime($now)) / (60 * 60 * 24) : null;
        
        // Calculate current week
        $weeks = $startdate ? ceil((strtotime($now) - strtotime($startdate)) / (60 * 60 * 24 * 7)) : null;
        
        $data['intern'] = $intern;
        $data['now'] = $now;
        $data['endate'] = $enddate;
        $data['days'] = $days;
        $data['week'] = $weeks;
    
        if ($role == "Student") {
            $student = $this->studentModel->where('studentid', session()->get('studentid'))->first();
            $logbook = $this->logbookModel->where('sid', $student['sid'])->first();
            $lbid = $logbook['lbid'];
            $taskcount = $this->taskModel->counttask($lbid);
            $task = $this->taskModel->gettask($lbid);
            $totalRemarks = $this->taskModel->countRemarks($lbid);
    
            $data['taskcount'] = $taskcount;
            $data['task'] = $task;
            $data['totalRemarks'] = $totalRemarks;
    
            return view('dashboard/dashboard', $data);
        } else {
            $user = $this->userModel->where('id', $id)->first();
            $lecturer = $this->lecturerModel->where('id', $user['id'])->first();
            $lid = $lecturer['lid'];
            $countstudent = $this->studentModel->countstudent($lid);
            $totalRemarks = $this->taskModel->countRemarks($lid);
            $recentRemarks = $this->taskModel->getRecentRemarks($lid);
    
            $data['cs'] = $countstudent;
            $data['lid'] = $lid;
            $data['totalRemarks'] = $totalRemarks;
            $data['recentRemarks'] = $recentRemarks;
    
            return view('dashboard/dashboardlect', $data);
        }
    }
}