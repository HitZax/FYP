<?php

namespace App\Models;

use CodeIgniter\Model;

class LecturerModel extends Model
{
    protected $table            = 'lecturer';
    protected $allowedFields    = ['lname','lemail','lroom', 'invcode'];
}
