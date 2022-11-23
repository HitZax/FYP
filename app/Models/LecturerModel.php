<?php

namespace App\Models;

use CodeIgniter\Model;

class LecturerModel extends Model
{
    protected $table            = 'lecturer';
    protected $primaryKey = 'lid';
    protected $allowedFields    = ['lid','lname','lemail','lroom', 'invcode', 'id'];
}
