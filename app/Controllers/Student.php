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
        // d($data);
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

        // dd($data);
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

        return redirect()->back()->with('message','insert');
    }

    public function edit($sid)
    {
        $studentmodel = new StudentModel();
        $student = $studentmodel->detail($sid);

        $data=[
            'title' => 'Student | Edit',
            'student' => $student
        ];

        // d($data);
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

        return redirect()->to('/student')->with('message','update');
    }

    public function delete($sid)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('student');
        $builder->where('sid', $sid);
        $builder->delete();

        return redirect()->back()->with('message','Delete');
    }

}
