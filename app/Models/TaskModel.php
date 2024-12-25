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
        return $this->where('lbid', $lbid)
                    ->countAllResults();
    }

    public function recenttask($lbid)
    {
        return $this->where('lbid', $lbid)
                    ->orderBy('tid', 'DESC')
                    ->first();
    }

    public function gettask($lbid)
    {
        return $this->where('lbid', $lbid)
                    ->orderBy('tdate', 'DESC') // Order by date in descending order
                    ->findAll(3); // Limit to 3 results
    }

    public function countRemarks($lbid)
    {
        return $this->where('lbid', $lbid)
                    ->where('remark !=', '') // Ensure remark is not empty
                    ->countAllResults();
    }

    public function getRecentRemarks($lbid)
    {
        return $this->select('task.*, student.sname')
                    ->join('student', 'student.sid = task.lbid')
                    ->where('task.lbid', $lbid)
                    ->where('task.remark !=', '') // Ensure remark is not empty
                    ->orderBy('task.tdate', 'DESC') // Order by date in descending order
                    ->findAll(3); // Limit to 3 results
    }
}