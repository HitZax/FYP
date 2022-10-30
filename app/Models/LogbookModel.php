<?php

namespace App\Models;

use CodeIgniter\Model;

class LogbookModel extends Model
{
    protected $table            = 'logbook';
    protected $allowedFields    = ['lbname','lbid','lbcreated', 'sid','lid'];
}
