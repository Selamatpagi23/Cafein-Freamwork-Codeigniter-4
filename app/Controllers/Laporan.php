<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\AntrianModel;
use App\Models\MenuModel;
use App\Models\PembelianModel;
use Dompdf\Dompdf;
use App\Models\MetaModel;

class Laporan extends BaseController
{
    protected $menuModel;
    protected $transaksiModel;
    protected $antrianModel;
    protected $pembelianModel;
    protected $metaModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->antrianModel = new AntrianModel();
        $this->menuModel = new MenuModel();
        $this->pembelianModel = new PembelianModel();
        $this->metaModel = new MetaModel();

    }

    public function index()
    {

        if (session()->get('user_role') == 'admin') {
            $meta = $this->metaModel->first();

            $data = [
                "meta" => $meta,
            ];
            return view('laporan', $data);
            
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to('Dashboard');
        }
    }

    public function laporanSemua()
    {
        $tanggalMulai = $this->request->getPost("tanggalMulai") . " 00:00:00";
        $tanggalSelesai = $this->request->getPost("tanggalSelesai") . " 23:59:59";

        $pembelian = $this->pembelianModel->where(["tanggal >=" => $tanggalMulai, "tanggal <=" => $tanggalSelesai, "statusAntrian !=" => 0])->findAll();

        echo json_encode($pembelian);
    }

    public function laporanMenu()
    {
        $tanggalMulai = $this->request->getPost("tanggalMulai") . " 00:00:00";
        $tanggalSelesai = $this->request->getPost("tanggalSelesai") . " 23:59:59";

        $pembelian = $this->pembelianModel->where(["tanggal >=" => $tanggalMulai, "tanggal <=" => $tanggalSelesai, "statusAntrian !=" => 0])->findAll();
        $dataLaporan = [];
        for ($i = 0; $i < count($pembelian); $i++) {
            $tidakAda = true;
            for ($j = 0; $j < count($dataLaporan); $j++) {
                if ($dataLaporan[$j]["id"] == $pembelian[$i]["idMenu"]) {
                    $tidakAda = false;
                    $dataLaporan[$j]["jumlah"] += $pembelian[$i]["jumlah"];
                    $dataLaporan[$j]["harga_akhir"] += $pembelian[$i]["harga_akhir"];
                    break;
                }
            }
            if ($tidakAda) {
                $menu = [
                    "id" => $pembelian[$i]["idMenu"],
                    "nama" => $pembelian[$i]["namaMenu"],
                    "jumlah" => $pembelian[$i]["jumlah"],
                    "harga" => $pembelian[$i]["harga"],
                    "harga_akhir" => $pembelian[$i]["harga_akhir"]
                ];
                array_push($dataLaporan, $menu);
            }
        }

        echo json_encode($dataLaporan);
    }

    public function laporanAntrian()
    {
        $tanggalMulai = $this->request->getPost("tanggalMulai") . " 00:00:00";
        $tanggalSelesai = $this->request->getPost("tanggalSelesai") . " 23:59:59";

        $pembelian = $this->pembelianModel->where(["tanggal >=" => $tanggalMulai, "tanggal <=" => $tanggalSelesai, "statusAntrian !=" => 0])->findAll();
        $dataLaporan = [];
        for ($i = 0; $i < count($pembelian); $i++) {
            $tidakAda = true;
            for ($j = 0; $j < count($dataLaporan); $j++) {
                if ($dataLaporan[$j]["id"] == $pembelian[$i]["idAntrian"]) {
                    $tidakAda = false;
                    $dataLaporan[$j]["jumlahPesan"] += 1;
                    $dataLaporan[$j]["harga_akhir"] += $pembelian[$i]["harga_akhir"];
                    break;
                }
            }
            if ($tidakAda) {
                $menu = [
                    "id" => $pembelian[$i]["idAntrian"],
                    "nama" => $pembelian[$i]["namaAntrian"],
                    "harga_akhir" => $pembelian[$i]["harga_akhir"],
                    "noMeja" => $pembelian[$i]["noMeja"],
                    "jumlahPesan" => 1,
                     
                ];
                array_push($dataLaporan, $menu);
            }
        }

        echo json_encode($dataLaporan);
    }

}
