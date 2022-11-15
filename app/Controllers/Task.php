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
            'title' => 'Task | OLS',
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
            'lbid' => $lbid
        ];
        
        // dd($data);
        $this->taskModel->save($data);

        return redirect()->to('/logbook');
    }
}
