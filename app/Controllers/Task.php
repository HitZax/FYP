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
        
        $data=[
            'title' => 'Student | Task',
            'sid' => session()->get('id'),
        ];
        // d($data);
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
        
        // d($data);
        $this->taskModel->insert($data);

        return redirect()->to('/logbook');
    }

        public function edit($lbid)
        {
        
        $task = $this->taskModel->find($lbid);

        $data=[
            'title' => 'Student | Task Report Edit',
            'task' => $task
        ];

        // d($data);
        return view('task/edit', $data);
        }

        public function update($tid)
        {

        $data=[
            // 'tid' => $tid,
            'tname' => $this->request->getVar('tname'),
            'tdate' => $this->request->getVar('tdate'),
            'tdesc' => $this->request->getVar('tdesc'),
            'tpic' => null,
        ];
        d($data);
        $this->taskModel->update($tid, $data);

        return redirect()->to('/logbook')->with('message','update');
        }

        public function delete($tid)
        {
        $db = \Config\Database::connect();
        $builder = $db->table('task');
        $builder->where('tid',$tid);
        $builder->delete();

        return redirect()->back()->with('message','Delete');
        }
}