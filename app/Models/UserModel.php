<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $allowedFields    = ['id',
    'email',
    'username',
    'password_hash',
    'reset_at',
    'reset_expires',
    'activate_hash',
    'status',
    'status_message',
    'active',
    'force_pass_reset',
    'created_at',
    'updated_at',
    'deleted_at',
    'studentid',
    'programname'];

    // public function detail($sid)
    // {
    //     $sql = ("SELECT * FROM student WHERE sid=$sid");
    //     $result = $this->db->query($sql);
    //     return $result->getRow();
    // }
}
