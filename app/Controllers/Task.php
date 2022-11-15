<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\LogbookModel;
use App\Controllers\BaseController;

class Task extends BaseController
{
    public function __construct()
    {
        $this->logbookModel = new LogbookModel();
        $this->taskModel = new TaskModel();
    }

    public function index()
    {
        $sid =session()->get('id');
        $lbid = $this->logbookModel->WHERE('sid', $sid)->first();

        $data=[
            'title' => 'Student | Task',
            'sid' => session()->get('id'),
            'lbid' => $lbid
        ];
        d($data);
        return view('task/task',$data);
    }

    public function store($lbid)
    {
        $data=[
            'tname' => $this->request->getVar('tname'),
            'tdesc' => $this->request->getVar('tdesc'),
            'tdate' => $this->request->getVar('tdate'),
            'tpic' => $this->request->getVar('tpic'),
            'lbid' => $lbid
        ];
        
        // dd($data);
        $this->taskModel->save($data);

        return redirect()->to('/logbook');
    }

        public function edit($lbid)
    {
        $taskmodel = new StudentModel();
        $task = $taskmodel->detail($lbid);

        $data=[
            'title' => 'Student | Task Report Edit',
            'lbid' => $task
        ];

        // d($data);
        return view('Student/logbook', $data);
    }

    public function update($lbid)
    {
        $taskmodel = new TaskModel();

        $data=[
            'sid' => $sid,
            'tname' => $this->request->getVar('tname'),
            'tdate' => $this->request->getVar('tdate'),
            'tdesc' => $this->request->getVar('tdesc'),
            'tpic' => $this->request->getVar('tpic'),
        ];
        // dd($data);
        $studentmodel->replace($data);

        return redirect()->to('/student/logbook')->with('message','update');
    }

    public function delete($lbid)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('task');
        $builder->where('lbid',$lbid);
        $builder->delete();

        return redirect()->back()->with('message','Delete');
    }
}