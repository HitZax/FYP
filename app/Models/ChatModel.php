<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table            = 'chat';
    protected $primaryKey       = 'chatid';
    protected $allowedFields    = ['message','timestamp','sid','lid'];
}
