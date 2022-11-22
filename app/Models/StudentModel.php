<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'student';
    protected $allowedFields    = ['sid','sname','sprogram','studentid', ];

    public function detail($sid)
    {
        $sql = ("SELECT * FROM student WHERE sid=$sid");
        $result = $this->db->query($sql);
        return $result->getRow();
    }

   
}
