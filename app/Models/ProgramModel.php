<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table            = 'program';
    protected $allowedFields    = ['pid','pname','pdesc'];

}
