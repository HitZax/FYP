<?php

namespace App\Models;

use CodeIgniter\Model;

class InternModel extends Model
{
    protected $table            = 'interndetail';
    protected $allowedFields    = ['id','sid','startdate','enddate','visitdate','reportdate'];

    public function detail($id)
    {
        $sql = ("SELECT * FROM interndetail WHERE id=$id");
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function updateAllEndDates($newEndDate)
    {
        $sql = "UPDATE interndetail SET enddate = ?";
        $this->db->query($sql, [$newEndDate]);
    }

    public function updateAllStartDates($newStartDate)
    {
        $sql = "UPDATE interndetail SET startdate = ?";
        $this->db->query($sql, [$newStartDate]);
    }
}