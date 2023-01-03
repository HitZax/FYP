<?php

namespace App\Controllers;

use App\Models\ChatModel;
use App\Models\TaskModel;
use App\Models\UserModel;
use App\Models\LogbookModel;
use App\Models\MessageModel;
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
        $this->messageModel = new MessageModel();
    }

    public function index()
    {
        if(session()->get('role')=="Student")
        {
        
        // $chat = $chatModel->find($sid);
            //find message by id
            $sid = session()->get('id');
            $chat = $this->chatModel->WHERE('sid', $sid)->first();
            //findchat id
            $chatid = $chat['chatid'];
            // dd($chatid);

            $messages = $this->messageModel->where('chatid', $chatid)->join('users', 'message.id = users.id')->findAll();
            $data=[
                'title' => 'Chat',
                'messages' => $messages,

            ];
            // dd($data);
            return view('chat/chat', $data);
        }
        else
        {
            $sid = session()->get('id');
            // $messages = $this->chatModel->WHERE('sid', $sid)->findAll();
            ///find message by id and join table user and table lecturer

            // $messages = $this->chatModel->WHERE('sid', $sid)->join('users', 'chat.sid = users.id')->findAll();

            //find message by id and join table user and table lecturer
            $messages = $this->chatModel->WHERE('sid', $sid)->join('users', 'chat.sid = users.id')->join('lecturer', 'chat.sid = lecturer.lid')->orderby('timestamp', 'ASC')->findAll();
            $data=[
                'title' => 'Chat',
                'messages' => $messages,

            ];
            d($data);
            return view('chat/chat', $data);
            // $user = $this->userModel->WHERE('id', session()->get('id'))->first();
            // $lecturer = $this->lecturerModel->WHERE('id', $user['id'])->first();
            // $lid = $lecturer['lid'];
            // $db = \Config\Database::connect();
            // $student = $db->table('student')
            //                 ->join('logbook', 'student.sid = logbook.sid')
            //                 ->where('logbook.lid', $lid)
            //                 ->get()->getResultArray();

            // $data=[
            //     'title' => 'Lecturer | Logbook',
            //     'user' => $user,
            //     'lecturer' => $lecturer,
            //     'student' => $student,
            //     'lid' => $lid
                
            // ];
            // // d($data);
            // return view('chat/chatview', $data);
        }
    }

    //create show method for lecturer
    public function show($sid)
    {
        $user = $this->userModel->WHERE('id', session()->get('id'))->first();
        $lecturer = $this->lecturerModel->WHERE('id', $user['id'])->first();
        $lid = $lecturer['lid'];
        $db = \Config\Database::connect();
        $student = $db->table('student')
                        ->join('logbook', 'student.sid = logbook.sid')
                        ->where('logbook.lid', $lid)
                        ->get()->getResultArray();

        // $messages = $this->chatModel->WHERE('sid', $sid)->join('users', 'chat.sid = users.id')->join('lecturer', 'chat.sid = lecturer.lid')->findAll();
        $data=[
            'title' => 'Lecturer | Logbook',
            'user' => $user,
            'lecturer' => $lecturer,
            'student' => $student,
            'lid' => $lid,
            // 'messages' => $messages,
            'sid' => $sid
            
        ];
        // d($data);
        return view('chat/chatview', $data);
    }

    //create insert method
    public function insert()
    {
        $sid = session()->get('id');
        $chat = $this->chatModel->WHERE('sid', $sid)->first();
            //findchat id
        $chatid = $chat['chatid'];

        $message = $this->request->getVar('message');
        $data = [
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s'),
            'id' => session()->get('id'),
            'chatid' => $chatid,
            // 'lid' => 
        ];
        // dd($data);
        $this->messageModel->insert($data);
        // return redirect()->to(base_url('chat'));
    }
}
