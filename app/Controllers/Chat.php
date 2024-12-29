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

    // Display chat messages
    public function index($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $chat = $this->chatModel->where('sid', $id)->first();
        if (!$chat) {
            return redirect()->to('/dashboard')->with('error', 'Chat not found');
        }
        $chatid = $chat['chatid'];
        $messages = $this->messageModel->where('chatid', $chatid)->join('users', 'message.id = users.id')->orderBy('messageid', 'ASC')->findAll();

        // Determine the role of the user
        $role = session()->get('role');
        if ($role == 'Student') {
            // Fetch the lecturer's name using the lecturer's ID
            $lecturer = $this->lecturerModel->where('id', $chat['id'])->first();
            $personName = $lecturer ? $lecturer['lname'] : 'Unknown';
        } else {
            // Fetch the student's name using the student's SID
            $student = $this->studentModel->where('sid', $id)->first();
            $personName = $student ? $student['sname'] : 'Unknown';
        }

        $data = [
            'title' => 'Chat',
            'messages' => $messages,
            'chatid' => $chatid,
            'personName' => $personName,
            'id' => $id,
        ];

        return view('chat/chat', $data);
    }

    // Display chat list for lecturer
    public function indexlect()
    {
        $sid = session()->get('id');
        $findallstudent = $this->chatModel
            ->join('student', 'student.sid = chat.sid')
            ->where('chat.id', $sid)
            ->findAll();

        $data = [
            'title' => 'Chat',
            'student' => $findallstudent,
        ];

        return view('chat/chatview', $data);
    }

    // Create new chat
    public function new()
    {
        $id = filter_var($this->request->getVar('id'), FILTER_SANITIZE_NUMBER_INT);
        $data = [
            'title' => 'Chat',
            'id' => $id,
        ];

        return view('chat/new', $data);
    }

    // Show chat for lecturer
    public function show($sid)
    {
        $user = $this->userModel->where('id', session()->get('id'))->first();
        $lecturer = $this->lecturerModel->where('id', $user['id'])->first();
        $lid = $lecturer['lid'];
        $db = \Config\Database::connect();
        $student = $db->table('student')
            ->join('logbook', 'student.sid = logbook.sid')
            ->where('logbook.lid', $lid)
            ->get()->getResultArray();

        $data = [
            'title' => 'Lecturer | Logbook',
            'user' => $user,
            'lecturer' => $lecturer,
            'student' => $student,
            'lid' => $lid,
            'sid' => $sid,
        ];

        return view('chat/chatview', $data);
    }

    // Insert new message
    public function insert()
    {
        $role = session()->get('role');
        $message = filter_var($this->request->getVar('message'), FILTER_SANITIZE_STRING);

        if ($role == 'Lecturer') {
            $chatid = filter_var($this->request->getVar('c'), FILTER_SANITIZE_NUMBER_INT);
        } elseif ($role == 'Student') {
            $sid = session()->get('id');
            $chat = $this->chatModel->where('sid', $sid)->first();
            if (!$chat) {
                return redirect()->back()->with('error', 'Chat not found');
            }
            $chatid = $chat['chatid'];
        } else {
            return redirect()->back()->with('error', 'Invalid role');
        }

        $data = [
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s'),
            'id' => session()->get('id'),
            'chatid' => $chatid,
        ];

        $this->messageModel->insert($data);
        return redirect()->back();
    }

    // Fetch messages for chat
    public function fetchMessages()
    {
        $chatid = filter_var($this->request->getVar('chatid'), FILTER_SANITIZE_NUMBER_INT);
        $messages = $this->messageModel->where('chatid', $chatid)->join('users', 'message.id = users.id')->orderBy('messageid', 'ASC')->findAll();

        return $this->response->setJSON(['messages' => $messages]);
    }
}