<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Chat extends BaseController
{
    public function index()
    {
        $data=[
            'title' => 'Chat',
        ];

        return view('chat/chat',$data);
    }
}
