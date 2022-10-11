<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Controllers\BaseController;

class Student extends BaseController
{
    public function show()
    {
        $studentmodel = new StudentModel();
        $student = $studentmodel->findall();

        $data=[
            'title' => 'Student List',
            'student' => $student
        ];
        d($data);
        return view('Student/show', $data);
    }

    //Lastseen @HitZax 
    public function detail($sid)
    {
        $studentmodel = new StudentModel();
        $student = $studentmodel->find($sid);

        $data=[
            'student' => $student
        ];

        dd($data);
    }

    public function insert()
    {
        $studentmodel = new StudentModel();

        $data=[
            'sname' => $this->request->getVar('name'),
            'studentid' => $this->request->getVar('studentid'),
            'sprogram' => $this->request->getVar('program'),
        ];
        // dd($data);
        $studentmodel->insert($data);
    }

    public function edit($sid)
    {
        $studentmodel = new StudentModel();
        $student = $studentmodel->detail($sid);

        $data=[
            'title' => 'Student | Edit',
            'student' => $student
        ];

        d($data);
        return view('Student/edit', $data);
    }

    public function update($sid)
    {
        $studentmodel = new StudentModel();

        $data=[
            'sid' => $sid,
            'sname' => $this->request->getVar('name'),
            'studentid' => $this->request->getVar('studentid'),
            'sprogram' => $this->request->getVar('program'),
        ];
        // dd($data);
        $studentmodel->replace($data);
    }

    public function delete($sid)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('event');
        $builder->where('eventid', $eventid);
        $builder->delete();
    }

}
