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
            'student' => $student
        ];

        dd($data);
    }

    public function detail($sid)
    {
        $studentmodel = new StudentModel();
        $student = $studentmodel->find($sid);

        $data=[
            'student' => $student
        ];

        dd($data);
    }
}
