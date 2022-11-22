<?php

namespace App\Models;

use CodeIgniter\Model;

class LogbookModel extends Model
{
    protected $table            = 'logbook';
    protected $primaryKey       = 'lbid';
    protected $allowedFields    = ['lbcreated', 'sid', 'lid'];

    public function detail($lid)
    {
        $sql = ("SELECT * FROM logbook WHERE lid = $lid");
        $result = $this->db->query($sql);
        return $result->getRowArray();
    }
}
