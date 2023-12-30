<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\AntrianModel;
use App\Models\TransaksiModel;
use App\Models\UsersModel;
use App\Models\MembershipModel;
use App\Models\PembelianModel;
use App\Models\PesanMasukModel;
use App\Models\MetaModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $menuModel;
    protected $antrianModel;
    protected $transaksiModel;
    protected $membershipModel;
    protected $pembelianModel;
    protected $pesanMasukModel;
    protected $metaModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->antrianModel = new AntrianModel();
        $this->transaksiModel = new TransaksiModel();
        $this->userModel = new UsersModel();
        $this->membershipModel = new MembershipModel();
        $this->pembelianModel = new PembelianModel();
        $this->pesanMasukModel = new PesanMasukModel();
        $this->metaModel = new MetaModel();
    }
    public function index()
    {
        $user = $this->userModel->findAll();
        unset($user["user_password"]);

        // Mengambil satu baris data dari tabel meta
        $meta = $this->metaModel->first();
        $data = [
            "user" => $user,
            "makanan" => $this->menuModel->where(["jenis" => 1, "hapus" => NULL])->findAll(),
            "snack" => $this->menuModel->where(["jenis" => 2, "hapus" => NULL])->findAll(),
            "minumanDingin" => $this->menuModel->where(["jenis" => 3, "hapus" => NULL])->findAll(),
            "minumanPanas" => $this->menuModel->where(["jenis" => 4, "hapus" => NULL])->findAll(),
            "membership" => $this->membershipModel->findAll(),
            "pembelian" => $this->pembelianModel->findAll(),
            "pesanMasuk" => $this->pesanMasukModel->findAll(),
            "antrian" => $this->antrianModel->findAll(),
            "meta" => $meta,
        ];
        return view('dashboard', $data);
    }

    public function getMembershipData()
    {
        $membershipData = $this->membershipModel->findAll();
        echo json_encode($membershipData);
    }
    public function getUserData()
    {
        $userData = $this->userModel->findAll();
        echo json_encode($userData);
    }
    public function tambahPesanan()
    {
        $nama = $this->request->getPost("nama");
        $noMeja = $this->request->getPost("noMeja");
        $total_bayar = $this->request->getPost("total_bayar");
        $pesanan = $this->request->getPost("pesanan");
        $harga_akhir = $this->request->getPost("harga_akhir");
        $idUser =  session()->get('user_id');

        $antrian = [
            "nama" => $nama,
            "noMeja" => $noMeja,
            "total_bayar" => $total_bayar,
            "idUser" => $idUser,
        ];

        $idAntian = $this->antrianModel->insert($antrian);

        for ($i = 0; $i < count($pesanan); $i++) {
            $menu = [
                "idMenu" => $pesanan[$i][0],
                "jumlah" => $pesanan[$i][2],
                "harga_akhir" => $harga_akhir[$i],
                "idAntrian" => $idAntian
            ];
            $this->transaksiModel->save($menu);
        }
        echo json_encode("");
    }

    public function dataOrder()
    {
        $antrianData = $this->antrianModel->findAll();
        $transaksiData = $this->transaksiModel->findAll();

        $combinedData = [
            'antrian' => $antrianData,
            'transaksi' => $transaksiData
        ];

        echo json_encode($combinedData);
    }

    public function joinMember()
    {
        $email = $this->request->getPost("email");

        // Cek apakah user_email sudah ada dalam basis data
        $existingEmail = $this->pesanMasukModel->where('email', $email)->first();

        if ($existingEmail) {
            return redirect()->to('/')->with('error', 'Maaf, Anda Sudah Mengajukan Sebelumnya...!');
        } else {

            $data = [
                "nama_user" => $this->request->getPost("nama_user"),
                "email" => $email,
                "jenis_member" => $this->request->getPost("jenis_member"),
                "bulan" => $this->request->getPost("bulan"),
                "status" => "tertunda",
                "user_id" => $this->request->getPost("user_id"),
            ];

            $this->pesanMasukModel->save($data);
            return redirect()->to('/')->with('success', 'Selamat, Pendaftaran Member Berhasil :) \n Silakan Cek Status Member...!');
        }
    }
}
