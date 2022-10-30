<?php

namespace App\Controllers;

use App\Models\LogbookModel;
use App\Controllers\BaseController;

class Logbook extends BaseController
{
    public function __construct()
    {
        $this->logbookmodel = new LogbookModel();
    }
    
    public function index()
    {

                $data=[
                    'title' => 'Student | Logbook',

                ];

                return view('logbook/logbook', $data);
    }

    public function insert()
    {

        $data=[
            'lbname' => $this->request->getVar('name'),
            'lbcreated' => $this->request->getVar(''),
        ];
        dd($data);
        $this->$logbookmodel->insert($data);

        return redirect()->back()->with('message','insert');
    }
}
