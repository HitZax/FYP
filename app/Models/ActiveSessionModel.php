<?php

namespace App\Models;
use CodeIgniter\Model;

class ActiveSessionModel extends Model
{
    protected $table = 'active_sessions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'session_id', 'created_at'];
}