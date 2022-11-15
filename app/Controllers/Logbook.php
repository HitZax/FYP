<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\LogbookModel;
use App\Models\StudentModel;
use App\Controllers\BaseController;

class Logbook extends BaseController
{
    public function __construct()
    {
        $this->logbookModel = new LogbookModel();
        $this->studentModel = new StudentModel();
        $this->taskModel = new TaskModel();
    }
    
    /**
     * ---------------------------------------------
     * Show Logbook Page
     * ---------------------------------------------
     */

    public function index()
    {
        $sid = $this->studentModel->WHERE('studentid', session()->get('id'))->first();
        $lbid = $this->logbookModel->WHERE('sid', $sid)->first();
        $data=[
            'title' => 'Student | Logbook',
            'sid' => session()->get('id'),
            'lbid' => $lbid,
            'task' => $this->taskModel->find($lbid)
        ];
        d($data);
        return view('logbook/logbook', $data);
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
