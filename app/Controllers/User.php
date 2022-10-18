<?php

namespace App\Controllers;

use Myth\Auth\Password;
use App\Models\UserModel;
// use App\Controllers\BaseController;

class User extends BaseController
{
    public function registerstudent()
    {
        //
    }

    public function showregform()
    {
        // $data['title'] = 'Register student | LS';

        // return view('auth/register', $data);
    }

    public function inserttodb()
    {
        $usermodel = new UserModel();

        $data=[
            'username' => $this->request->getVar('fullname'),
            'studentid' => $this->request->getVar('studentid'),
            'password_hash' => Password::hash($this->request->getVar('password')),
            'programname' => $this->request->getVar('program'),
            'email' => $this->request->getVar('email'),

        ];
        // dd($data);
        $usermodel->insert($data);
        // return redirect()->to('/login');
    }
}
