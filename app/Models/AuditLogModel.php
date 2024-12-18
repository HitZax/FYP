<?php

namespace App\Models;
use CodeIgniter\Model;

class AuditLogModel extends Model
{
    protected $table = 'audit_log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'action', 'status', 'attempt_number', 'ip_address', 'user_agent', 'timestamp'];
}