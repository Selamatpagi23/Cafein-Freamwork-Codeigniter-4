<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\MetaModel;


class User extends BaseController
{
    protected $userModel;
    protected $metaModel;


    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->metaModel = new MetaModel();

    }
    public function index()
    { 
        if (session()->get('user_role') == 'admin') {
            $meta = $this->metaModel->first();

            $data = [
                "meta" => $meta,
            ];
            return view('user', $data);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to('Dashboard');
        }
    }
    
    public function muatData()
    {
        echo json_encode($this->userModel->findAll());
    }

    public function tambah()
    {
        $data = [
            "user_name" => $this->request->getPost("user_name"),
            "user_email" => $this->request->getPost("user_email"),
            "user_role" => $this->request->getPost("user_role"),
            "user_password"=> password_hash($this->request->getVar("user_password"), PASSWORD_DEFAULT),
        ];

        $this->userModel->save($data);

        echo json_encode("");
    }
 
    public function hapus()
    {
        $id = $this->request->getPost("user_id");
        if ($id) {
            // Hapus data anggota berdasarkan id_member
            $this->userModel->delete($id);

            // Mengembalikan respon JSON
            echo json_encode("Data ID " . $id . " telah dihapus.");
        } else {
            echo json_encode("ID kosong");
        }
    }
}
