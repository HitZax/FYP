<?php

namespace App\Controllers;

use App\Models\ChatModel;
use App\Models\TaskModel;
use App\Models\UserModel;
use App\Models\LogbookModel;
use App\Models\StudentModel;
use App\Models\LecturerModel;
use App\Controllers\BaseController;

class Chat extends BaseController
{
    //create constructor
    public function __construct()
    {
        $this->chatModel = new ChatModel();
        $this->logbookModel = new LogbookModel();
        $this->studentModel = new StudentModel();
        $this->lecturerModel = new LecturerModel();
        $this->taskModel = new TaskModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if(session()->get('role')=="Student")
        {
        
            $data=[
                'title' => 'Chat',
            ];
            d($data);
            return view('chat/chat', $data);
        }
        else
        {

            $user = $this->userModel->WHERE('id', session()->get('id'))->first();
            $lecturer = $this->lecturerModel->WHERE('id', $user['id'])->first();
            $lid = $lecturer['lid'];
            $db = \Config\Database::connect();
            $student = $db->table('student')
                            ->join('logbook', 'student.sid = logbook.sid')
                            ->where('logbook.lid', $lid)
                            ->get()->getResultArray();

            $data=[
                'title' => 'Lecturer | Logbook',
                'user' => $user,
                'lecturer' => $lecturer,
                'student' => $student,
                'lid' => $lid
                
            ];
            // d($data);
            return view('chat/chatview', $data);
        }
    }

    //create insert method
    public function insert()
    {
        $message = $this->request->getVar('message');
        $data = [
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s'),
            'sid' => session()->get('id'),
            // 'lid' => 
        ];
        // dd($data);
        $this->chatModel->insert($data);
        // return redirect()->to(base_url('chat'));
    }
}
