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
            'title' => 'Task | OLS',

        ];
        
        return view('task/task',$data);
    }

    public function store($lbid)
    {
        $data=[
            'tname' => $tdname,
            'tdesc' => $tdesc,
            'tdate' => $tdate,
        ];
        
        return view('task/task',$data);
    }
}
