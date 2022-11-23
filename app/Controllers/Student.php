<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;
use App\Models\InternModel;
use App\Models\LogbookModel;
use App\Models\ProgramModel;
use App\Models\StudentModel;
use App\Models\LecturerModel;
use App\Controllers\BaseController;

class Student extends BaseController
{
   
    public function __construct()
    {
        $this->logbookModel = new LogbookModel();
        $this->studentModel = new StudentModel();
        $this->lecturerModel = new LecturerModel();
        $this->taskModel = new TaskModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        return redirect()->to('/login');
    }
    
    public function show()
    {
        
        // $session = session();

        //kat sini aq tambah line ni hadi @HitZax
        if (session()->get('role') == "Lecturer")
        {
            $user = $this->userModel->WHERE('id', session()->get('id'))->first();
            $lecturer = $this->lecturerModel->WHERE('id', $user['id'])->first();

            $lid = $lecturer['lid'];
            $studentmodel = new StudentModel();
            $student = $studentmodel->WHERE('lid',$lid)->findall();

            $programmodel = new ProgramModel();
            $program = $programmodel->findall();

            $internmodel = new InternModel();
            $intern = $internmodel->findall();

            $usernmodel = new UserModel();
            $user = $usernmodel->findall();
        
            $data=[
            'title' => 'Student List',
            'student' => $student,
            'program' => $program,
            'intern' => $intern,
            'user' => $user,
               'lecturer' => $lecturer,
                'student' => $student,
                'lid' => $lid
            
            // 'role' => $session->get('role')
            ];
            // dd($data);
            return view('Student/show', $data);
        }
        else
        {
            return redirect()->to('/dashboard');
        }
          
    }

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

    public function update($id)
    {
        $studentmodel = new StudentModel();
        $internmodel = new InternModel();
        
        $data=[
            // 'id' => $id,
            'reportdate' => $this->request->getVar('reportdate'),
            'visitdate' => $this->request->getVar('visitdate'),
        ];
        // dd($data);
        $internmodel->update($id, $data);

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
