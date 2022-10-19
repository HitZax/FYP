<?php

namespace App\Models;

use CodeIgniter\Model;

class InviteCodeModel extends Model
{
    protected $table            = 'invitecode';
    protected $allowedFields    = ['invid','invcode'];

}
