<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\MembershipModel;
use App\Models\MetaModel;


class Membership extends BaseController
{
    protected $userModel;
    protected $memberModel;
    protected $metaModel;


    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->memberModel = new MembershipModel();
        $this->metaModel = new MetaModel();
    }

    public function index()
    {
        if (session()->get('user_role') == 'admin') {
            $user = $this->userModel->findAll();
            $meta = $this->metaModel->first();

            $data = [
                "user" => $user,
                "meta" => $meta
            ];
            return view('membership', $data);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to('Dashboard');
        }
    }

    public function tambahMember()
    {
        $user_id = $this->request->getPost("user_id");

        // Cek apakah user_id sudah ada dalam basis data MembershipModel
        $existingMember = $this->memberModel->where('user_id', $user_id)->first();

        if ($existingMember) {
            // User_id sudah ada dalam basis data MembershipModel, tampilkan pesan peringatan
            $response = ["error" => "Member sudah ada, silakan hapus untuk menambah member atau menambah masa aktif."];
        } else {
            // Cek apakah user_id ada dalam basis data UsersModel
            $existingUser = $this->userModel->where('user_id', $user_id)->first();

            if (!$existingUser) {
                // User_id tidak ada dalam basis data UsersModel, tampilkan pesan peringatan
                $response = ["error" => "User ID tidak ditemukan."];
            } else {
                // User_id belum ada dalam MembershipModel, tambahkan member baru
                $data = [
                    "user_id" => $user_id,
                    "level_member" => $this->request->getPost("level_member"),
                    "sampai" => $this->request->getPost("sampai")
                ];

                $this->memberModel->save($data);
                $response = ["success" => "Berhasil menambahkan member."];
            }
        }

        echo json_encode($response);
    }

    public function dataMember()
    {
        // Mengambil data dari kedua model
        $userData = $this->userModel->findAll();
        $memberData = $this->memberModel->findAll();

        // Menggabungkan data dari kedua model menjadi satu array
        $combinedData = [
            'users' => $userData,
            'members' => $memberData,
        ];

        // Mengembalikan data JSON yang berisi data gabungan
        return json_encode($combinedData);
    }

    public function hapusData()
    {
        $id = $this->request->getPost("id_member");
        if ($id) {
            // Hapus data anggota berdasarkan id_member
            $this->memberModel->delete($id);

            // Mengembalikan respon JSON
            echo json_encode("Data member dengan ID " . $id . " telah dihapus.");
        } else {
            echo json_encode("ID kosong");
        }
    }
}
