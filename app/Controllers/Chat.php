<?php

namespace App\Controllers;

use App\Models\ChatModel;
use App\Controllers\BaseController;

class Chat extends BaseController
{
    //create constructor
    public function __construct()
    {
        $this->chatModel = new ChatModel();
    }
    public function index()
    {
        $data=[
            'title' => 'Still Ongoing',
        ];

        return view('chat/chat',$data);
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
        $this->chatModel->insert($data);
        // return redirect()->to(base_url('chat'));
    }
}
