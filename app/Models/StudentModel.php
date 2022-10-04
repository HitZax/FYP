<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'student';
    protected $allowedFields    = ['sid','sname','sprogram'];
}
