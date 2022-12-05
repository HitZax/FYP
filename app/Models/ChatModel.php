<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table            = 'chat';
    protected $allowedFields    = ['chatid','message','timestamp','sid','lid','lbid'];
}
