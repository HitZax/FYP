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
            $task = $this->taskModel->WHERE('lbid',$logbook['lbid'])->findAll();
        
            $data=[
                'title' => 'Student | Logbook',
                'student' => $student,
                'logbook' => $logbook,
                'task' => $task
            ];
            return view('logbook/logbook', $data);
        }
        else
        {

            $lecturer = $this->userModel->WHERE('id', session()->get('id'))->first();
            $logbook = $this->logbookModel->WHERE('lid', $lecturer['id'])->first();
            // $task = $this->logbookModel->WHERE('lid',$logbook['lid'])->findAll();
            $student = $this->studentModel->WHERE('lid',$lecturer['id'])->findAll();


            $data=[
                'title' => 'Lecturer | Logbook',
                'lecturer' => $lecturer,
                'logbook' => $logbook,
                // 'task' => $task,
                'student' => $student
                
            ];
            // dd($data);
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

}
