<?php

namespace App\Models;

use CodeIgniter\Model;

class InternModel extends Model
{
    protected $table            = 'interndetail';
    protected $allowedFields    = ['internid','id','startdate','enddate','visitdate','reportdate'];
    // 'svnum','svname','location'

    public function detail($id)
    {
        $sql = ("SELECT * FROM interndetail WHERE id=$id");
        $result = $this->db->query($sql);
        return $result->getRow();
    }
}


