<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    
    protected $table            = 'message';
    protected $primaryKey       = 'messageid';
    protected $allowedFields    = ['message', 'timestamp', 'chatid', 'id'];

    
}
