<?php

namespace App\Models;
use CodeIgniter\Model;

class TwoFACodeModel extends Model
{
    protected $table = 'two_fa_codes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'code', 'expires_at'];
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $validationRules = [
        'user_id' => 'required|integer',
        'code' => 'required|string|max_length[6]',
        'expires_at' => 'required|valid_date'
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
}