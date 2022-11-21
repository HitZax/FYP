<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'task';
    protected $primaryKey       = 'tid';
    protected $allowedFields    = ['tid','tname','tdesc','tdate','remark','lbid','tpic'];

    public function counttask($lbid)
    {
        $sql = "SELECT COUNT(*) AS `numrows` FROM `task` WHERE lbid = $lbid";
        return $this->db->query($sql)->getRowArray();
    }

        public function recenttask($lbid)
    {
        $sql = "SELECT * FROM `task` WHERE id=(SELECT MAX(3) FROM `task`);";
        return $this->db->query($sql)->getRowArray();
    }
    
}
