<?php
namespace App\Models;

use CodeIgniter\Model;

class TwoFACodeModel extends Model
{
    protected $table = '2fa_code';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'code',
        'created_at',
        'expires_at',
        'used'
    ];
}