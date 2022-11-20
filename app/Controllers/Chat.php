<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Chat extends BaseController
{
    public function index()
    {
        $data=[
            'title' => 'Still Ongoing',
        ];

        return view('chat/chat',$data);
    }
}
