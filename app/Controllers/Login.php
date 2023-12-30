<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Login extends BaseController
{
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

    public function auth_pelanggan()
    {
        $session = session();
        $model = new UsersModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('user_password');
        $data = $model->where('user_email', $email)->first();

        if ($data) {
            $pass = $data['user_password'];
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                $ses_data = [
                    'user_id' => $data['user_id'],
                    'user_name' => $data['user_name'],
                    'user_email' => $data['user_email'],
                    'user_role' => $data['user_role'], // Menyimpan informasi peran (role) pengguna
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                // Redirect berdasarkan user_role
                if ($data['user_role'] == 'pelanggan') {
                    return redirect()->to('/')->with('success', 'Selamat, Login Berhasil..');
                } else {
                    // Jadi selain user role diatas maka akan keluar otomatis 
                    $session = session();
                    $session->destroy();
                    return redirect()->to('/')->with('error', 'Email & Password Tidak Ditemukan...!');
                }
            } else {
                return redirect()->to('/')->with('error', 'Password Salah');
            }
        } else {
            return redirect()->to('/')->with('error', 'Email Tidak Ditemukan');
        }
    }

    // public function auth()
    // {
    //     $usersModel = new UsersModel();
    //     $id = $this->request->getPost('idUser');
    //     $password = $this->request->getPost('pass');
    //     $user = $usersModel->where('id', $id)->first();

    //     if (empty($user)) {
    //         echo json_encode('<span class="badge badge-danger">Username Salah :(</span>');
    //     } else if (password_verify($password, $user['password'])) {
    //         session()->set('nama', $user["nama"]);
    //         session()->set('rule', $user["rule"]);
    //         session()->set('id', $user["id"]);
    //         echo json_encode("");
    //     } else {
    //         echo json_encode('<span class="badge badge-danger">Password Salah :(</span>');
    //     }
    // }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
