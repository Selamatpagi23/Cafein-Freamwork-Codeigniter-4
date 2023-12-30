<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\MetaModel;

class Admin extends BaseController
{
    protected $metaModel;

    public function __construct()
    {
        $this->metaModel = new MetaModel();
    }
    public function index()
    {
        if (session()->get('user_role') == 'admin') {
            $meta = $this->metaModel->first();

            $data = [
                "meta" => $meta,
            ];
            return view('antrian', $data);
        } else {
            $meta = $this->metaModel->first();

            $data = [
                "meta" => $meta,
            ];
            return view('login_admin', $data);
        }
    }

    // public function daftar(){
    //     helper(['form']);
    //     $session = session();

    //     $rules = [
    //         'name'   => 'required|min_length[3]|max_length[20]',
    //         'email'  => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
    //         'password'   => 'required|min_length[8]|max_length[20]',
    //         'confpassword' => 'matches[password]'
    //     ];

    //     if ($this->validate($rules)) {
    //         $model = new UsersModel();
    //         $data = [
    //             'user_name'     => $this->request->getVar('name'),
    //             'user_email'     => $this->request->getVar('email'),
    //             'user_password'     => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
    //             'user_role'     => $this->request->getVar('user_role')

    //         ];
    //         $model->save($data);
    //         return redirect()->to('Admin')->with('success', 'Selamat, Pendaftaran Berhasil!..');;
    //     } else {
    //         $data['validation'] = $this->validator;
    //         return redirect()->to('Admin')->with('error', 'Gagal, Silakan Coba Lagi!..');
    //     }
    // }
    
    public function auth_admin()
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
                if ($data['user_role'] == 'admin') {
                    return redirect()->to('Antrian');
                } else {
                    // Jadi selain user role diatas maka akan keluar otomatis 
                    $session = session();
                    $session->destroy();
                    return redirect()->to('Antrian');
                }
            } else {
                return redirect()->to('Admin')->with('error', 'Password Salah');
            }
        } else {
            return redirect()->to('Admin')->with('error', 'Email Tidak Ditemukan');
        }
    }

    
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('Admin');
    }
}
