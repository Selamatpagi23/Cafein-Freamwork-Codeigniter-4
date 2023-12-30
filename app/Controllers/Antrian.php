<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\AntrianModel;
use App\Models\TransaksiModel;
use App\Models\MetaModel;

class Antrian extends BaseController
{
    protected $menuModel;
    protected $antrianModel;
    protected $transaksiModel;
    protected $metaModel;

    
    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->antrianModel = new AntrianModel();
        $this->transaksiModel = new TransaksiModel();
        $this->metaModel = new MetaModel();

    }
    public function index()
    {
        if (session()->get('user_role') == 'admin') {
             // Mengambil satu baris data dari tabel meta
        $meta = $this->metaModel->first();

        $data = [   
            "meta" => $meta,
        ];
            return view('antrian', $data);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to('Dashboard');
        }
    }

    public function dataAntrian()
    {
        // untuk keamanan agar tidak bisa akses sebelum login
        if (session()->get('user_role') == 'admin') { 
            echo json_encode($this->antrianModel->where("status !=", 2)->findAll());
        } else {
            return redirect()->to('Dashboard');
        }
    }

    public function dataAntrianSelesai()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d', strtotime('today')) . " 00:00:00";
        echo json_encode($this->antrianModel->where(["status" => 2, "tanggal >=" =>  $tanggal])->findAll());
    }

    public function proses()
    {
        $id = $this->request->getPost("idTransaksi");
        $status = $this->request->getPost("statusTransaksi");
        $data = ["status" => $status + 1];
        if ($status < 0) {
            $data["idUser"] = session()->get('id');
            date_default_timezone_set("Asia/Jakarta");
            $data["tanggal"] = date('Y-m-d h:m:s', strtotime('today'));
        }

        $this->antrianModel->update($id, $data);

        echo json_encode("");
    }

    public function rincianPesanan()
    {
        $idAntian = $this->request->getPost("idAntrian");

        $pesanan = $this->transaksiModel->where("idAntrian", $idAntian)->findAll();
        for ($i = 0; $i < count($pesanan); $i++) {
            $menu = $this->menuModel->where("id", $pesanan[$i]["idMenu"])->first();
            $antrian = $this->antrianModel->where("id", $pesanan[$i]["idAntrian"])->first();
            $pesanan[$i]["nama"] = $menu["nama"];
            $pesanan[$i]["harga"] = $menu["harga"];
            $pesanan[$i]["total_bayar"] = $antrian["total_bayar"];
        }
        echo json_encode($pesanan);
    }
}
