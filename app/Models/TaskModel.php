<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'task';
    protected $allowedFields    = ['tid','tname','tdesc','tdate','remark','lbid'];

}
