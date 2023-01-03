<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;
use App\Models\LogbookModel;
use App\Models\StudentModel;
use App\Models\LecturerModel;
use App\Controllers\BaseController;

class Logbook extends BaseController
{
    public function __construct()
    {
        $this->logbookModel = new LogbookModel();
        $this->studentModel = new StudentModel();
        $this->lecturerModel = new LecturerModel();
        $this->taskModel = new TaskModel();
        $this->userModel = new UserModel();
    }
    
    /**
     * ---------------------------------------------
     * Show Logbook Page
     * ---------------------------------------------
     */

    public function index()
    {
        if(session()->get('role')=="Student")
        {
            $student = $this->studentModel->WHERE('studentid', session()->get('studentid'))->first();
            $logbook = $this->logbookModel->WHERE('sid', $student['sid'])->first();
            $task = $this->taskModel->WHERE('lbid',$logbook['lbid'])->Orderby('tdate', 'DESC')->findAll();
        
            $data=[
                'title' => 'Student | Logbook',
                'student' => $student,
                'logbook' => $logbook,
                'task' => $this->taskModel->WHERE('lbid',$logbook['lbid'])->Orderby('tdate', 'DESC')->paginate(10, 'task'),
                'pager' => $this->taskModel->pager,
            ];
            d($data);
            return view('logbook/logbook', $data);
        }
        else
        {

            $user = $this->userModel->WHERE('id', session()->get('id'))->first();
            $lecturer = $this->lecturerModel->WHERE('id', $user['id'])->first();
            $lid = $lecturer['lid'];
            $db = \Config\Database::connect();
            $student = $db->table('student')
                            ->join('logbook', 'student.sid = logbook.sid')
                            ->where('logbook.lid', $lid)
                            ->get()->getResultArray();

            $data=[
                'title' => 'Lecturer | Logbook',
                'user' => $user,
                'lecturer' => $lecturer,
                'student' => $student,
                'lid' => $lid
                
            ];
            // d($data);
            return view('logbook/logbooklect', $data);
        }

    }

    public function insert()
    {

        $data=[
            'lbname' => $this->request->getVar('name'),
            'lbcreated' => $this->request->getVar(''),
        ];
        // dd($data);
        $this->$logbookmodel->insert($data);

        return redirect()->back()->with('message','insert');
    }

    public function taskdetail($lbid)
    {
        $user = $this->userModel->WHERE('id', session()->get('id'))->first();
        $lecturer = $this->lecturerModel->WHERE('id', $user['id'])->first();
        $lid = $lecturer['lid'];
        $db = \Config\Database::connect();
        $student = $db->table('student')
                ->join('logbook', 'student.sid = logbook.sid')
                ->where('logbook.lid', $lid)
                ->get()->getResultArray();
       
        // $studname = $this->studentModel->find

        
        $data=[
            'title' => 'Logbook Detail Task',
            'task' => $this->taskModel->Where('lbid', $lbid)->Orderby('tdate', 'DESC')->findAll(),
            'student' => $student,
            // 'lbid' => $lbid
        ];
        // d($data);
        return view('logbook/logbookview', $data);
    }

}
