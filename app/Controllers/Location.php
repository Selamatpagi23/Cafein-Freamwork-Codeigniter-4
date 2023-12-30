<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MetaModel;
use App\Models\MembershipModel;
use App\Models\AntrianModel;



class Location extends BaseController
{
    protected $metaModel;
    protected $membershipModel;
    protected $antrianModel;
    
    public function __construct()
    {
        $this->metaModel = new MetaModel();
        $this->membershipModel = new MembershipModel();
        $this->antrianModel = new AntrianModel();

    }
    public function index()
    {
        $meta = $this->metaModel->first();

        $data = [
            "membership" => $this->membershipModel->findAll(),
            "antrian" => $this->antrianModel->findAll(),
            "meta" => $meta,
        ];
        return view('location', $data); 
    }
}