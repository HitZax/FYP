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

    public function index($id)
    {
        // dd($id);
            $chat = $this->chatModel->WHERE('sid', $id)->first();
        // dd($id);
        $chatid = $chat['chatid'];
        $messages = $this->messageModel->where('chatid', $chatid)->join('users', 'message.id = users.id')->OrderBy('messageid', 'ASC')->findAll();
        // $now = time("Y-m-d",strtotime($intern->enddate));

        $data=[
            'title' => 'Chat',
            'messages' => $messages,
        ];
        // dd($data);
        return view('chat/chat', $data);
        
            // //find message by id
            // $sid = session()->get('id');
            // $chat = $this->chatModel->WHERE('sid', $sid)->first();
            // //findchat id
        
            // if(empty($chat))
            // {
            //     // $chatid = $chat['chatid'];
            //     // $messages = $this->messageModel->where('chatid', $chatid)->join('users', 'message.id = users.id')->findAll();
            //     //get lid
            //     $findstudent = $this->studentModel->WHERE('sid', $sid)->first();

            //     $lid = $findstudent['lid'];
            //     $data=[
            //         'title' => 'Chat',
            //         'messages' => [],
            //         'lid' => $lid,
            //     ];
            //     // dd($data);
            //     return view('chat/chat', $data);
            // }
            // else
            // {
              
            // }
            // dd($chatid);
      
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

    public function indexlect()
    {
        $sid = session()->get('id');
           
            $findallstudent = $this->chatModel->join('student', 'student.sid = chat.sid')->WHERE('id', $sid)->findall();
            
            // dd($findallstudent);
            $data=[
                'title' => 'Chat',
                'student' => $findallstudent,

            ];
            d($data);
            return view('chat/chatview', $data);
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

    public function new()
    {
        $id = $this->request->getVar('id');
        // $sid = session()->get('id');
        $data=[
            'title' => 'Chat',
            'id' => $id,
        ];
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
        dd($data);
        return view('chat/chatview', $data);
    }


    // public function insert()
    // {
    //     $sid = session()->get('id');
    //     $chat = $this->chatModel->WHERE('sid', $sid)->first();
    //     $chatid = $chat['chatid'];
    //     $message = $this->request->getVar('message');

    //     $data = [
    //         'message' => $message,
    //         'timestamp' => date('Y-m-d H:i:s'),
    //         'id' => session()->get('id'),
    //         'chatid' => $chatid,
    //         // 'lid' => 
    //     ];
    //     dd($data);
    //     $this->messageModel->insert($data);
    //     // return redirect()->to(base_url('chat'));
    // }

    public function insert()
    {
        if(session()->get('role')=="Lecturer")

        {
        $sid = session()->get('id');
        // dd($sid);
        $chatid = $this->request->getVar('c');
        // dd($chatid);
        // $chat = $this->chatModel->WHERE('id', $sid)->first();
        // $chatid = $chat['chatid'];
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
        return redirect()->back();
        }
        elseif(session()->get('role')=="Student")
        {
            $sid = session()->get('id');
            d($sid);
            $chat = $this->chatModel->WHERE('sid', $sid)->first();
            // dd($chat);
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
            return redirect()->back();
        }
        else
        {
            echo'Error';
        }
    }

    public function fetchMessages()
    {
        $chatid = $this->request->getVar('chatid');
        $messages = $this->messageModel->where('chatid', $chatid)->join('users', 'message.id = users.id')->OrderBy('messageid', 'ASC')->findAll();

        return $this->response->setJSON(['messages' => $messages]);
    }

    public function sendMessage()
    {
        $message = $this->request->getVar('message');
        $chatid = $this->request->getVar('chatid');
        $data = [
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s'),
            'id' => session()->get('id'),
            'chatid' => $chatid,
        ];
        $this->messageModel->insert($data);

        return $this->response->setJSON(['status' => 'success']);
    }
}
