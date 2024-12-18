<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'student';
    protected $allowedFields    = ['sid','lid','sname','sprogram','studentid','id'];
    protected $returnType     = 'array';

    public function detail($sid)
    {
        $sql = ("SELECT * FROM student WHERE sid=$sid");
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function countstudent($lid)
    {
        $sql = ("SELECT COUNT(*) AS `numrows` FROM `student` WHERE lid =  $lid");
        $result = $this->db->query($sql);
        return $result->getRowArray();
    }

   
}
