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
        $file = $this->request->getFile('tpic');
        
        if ($file == null)
        {
            $data = [
                'tname' => $this->request->getVar('tname'),
                'tdesc' => $this->request->getVar('tdesc'),
                'tdate' => $this->request->getVar('tdate'),
                'tpic' => null,
                'lbid' => $lbid,
            ];
            $this->taskModel->insert($data);

            return redirect()->to('/logbook');
        }
        else
        {
            $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
            
            if ($file->isValid() && in_array($file->getMimeType(), $validMimeTypes))
            {
                $file->move('asset/img/task');
                
                $data = [
                    'tname' => $this->request->getVar('tname'),
                    'tdesc' => $this->request->getVar('tdesc'),
                    'tdate' => $this->request->getVar('tdate'),
                    'tpic' => $file->getName(),
                    'lbid' => $lbid
                ];
                
                $this->taskModel->insert($data);

                return redirect()->to('/logbook');
            }
            else
            {
                // Handle invalid file type
                return redirect()->back()->with('error', 'Invalid file type. Only images and PDF files are allowed.');
            }
        }
    }

    public function detail($lbid)
    {
        $task = $this->taskModel->find($lbid);

        $data=[
            'title' => 'Student | Task Report Show',
            'task' => $this->taskModel->where('lbid',$lbid)->first(),
        ];

        return view('task/show', $data);
    }

    public function edit($lbid)
    {
        $task = $this->taskModel->find($lbid);

        $data=[
            'title' => 'Student | Task Report Edit',
            'task' => $task
        ];

        return view('task/edit', $data);
    }

    public function update($tid)
    {
        if($this->request->getFile('tpic') == null)
        {
            $data=[
                'tname' => $this->request->getVar('tname'),
                'tdate' => $this->request->getVar('tdate'),
                'tdesc' => $this->request->getVar('tdesc'),
            ];
            $this->taskModel->update($tid, $data);

            return redirect()->to('/logbook')->with('message','update');
        }
        else
        { 
            $getfiles = $this->request->getFile('tpic');
            $getfiles->move('asset/img/task');

            $data=[
                'tname' => $this->request->getVar('tname'),
                'tdesc' => $this->request->getVar('tdesc'),
                // 'tpic' => $getfiles->getName(),
            ];
            
            // d($data);
            $this->taskModel->update($tid, $data);

            return redirect()->to('/logbook')->with('message','update');
        }
    }

    public function updatefile($tid)
    {
        $getfiles = $this->request->getFile('tpic');
        
        $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
        
        if ($getfiles->isValid() && in_array($getfiles->getMimeType(), $validMimeTypes))
        {
            $getfiles->move('asset/img/task');
            
            $data = [
                'tpic' => $getfiles->getName(),
                'tid' => $tid,
            ];
            
            $this->taskModel->update($tid, $data);

            return redirect()->to('/logbook')->with('message', 'update');
        }
        else
        {
            // Handle invalid file type
            return redirect()->back()->with('error', 'Invalid file type. Only images and PDF files are allowed.');
        }
    }


    public function delete($tid)
    {
    $db = \Config\Database::connect();
    $builder = $db->table('task');
    $builder->where('tid',$tid);
    $builder->delete();

    return redirect()->back()->with('message','Delete');
    }

    public function show($lbid)
    {
        $task = $this->taskModel->find($lbid);

        $data=[
            'title' => 'Student | Task Report Show',
            'task' => $task
        ];
         d($data);

        return view('task/show', $data);
    }   

    public function remark($lbid)
    {
        
         $data=[
            'remark' => $this->request->getVar('remark'),
            
        ];
            $this->taskModel->update($lbid, $data);

         return redirect()->back()->with('message','update');
    }   
}