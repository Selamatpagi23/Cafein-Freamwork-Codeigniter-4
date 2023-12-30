<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Register extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }
    public function index()
    {
        session();
        $session = session();
        $email = session()->get('user_email');
        $userRole = session()->get('user_role');

        if (isset($email) && $userRole === 'pelanggan') {
            return redirect()->to('/')->with('success', 'Selamat, Anda Sudah Login..');
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to('/');
        }
    }

    public function daftar_pelanggan()
    {
        $user_email = $this->request->getPost("user_email");

        // Cek apakah user_email sudah ada dalam basis data
        $existingEmail = $this->userModel->where('user_email', $user_email)->first();

        if ($existingEmail) {
            // User_email sudah ada dalam basis data userModel, tampilkan pesan peringatan
            $response = ["error" => "Email Sudah Dipakai..!"];
        } else {

            // User_email belum ada dalam, tambahkan pelanggan baru
            $data = [
                "user_name" => $this->request->getPost("user_name"),
                "user_email" => $user_email,
                "user_role" => $this->request->getPost("user_role"),
                "user_password" => password_hash($this->request->getVar("user_password"), PASSWORD_DEFAULT),
            ];

            $this->userModel->save($data);
            $response = ["success" => "Pendaftaran Berhasil :) \n Silakan Login...!"];
        }

        echo json_encode($response);
    }
}
