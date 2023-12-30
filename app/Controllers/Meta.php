<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MetaModel;


class Meta extends BaseController
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
            return view('meta', $data);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to('Dashboard');
        }
    }

    public function dataMeta()
    {
        if (session()->get('user_role') == 'admin') {
            echo json_encode($this->metaModel->findAll());
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to('Dashboard');
        }
    }

    public function updateMeta()
    {
        if (session()->get('user_role') == 'admin') {
            $request = $this->request;
            $id_meta = $request->getPost('id_meta');
            $alamat_toko = $request->getPost('alamat_toko');
            $facebook = $request->getPost('facebook');
            $youtube = $request->getPost('youtube');
            $email = $request->getPost('email');
            $logo = $request->getFile('logo');
            $favicon = $request->getFile('favicon');
            $title = $request->getPost('title');
            $description = $request->getPost('description');
            $keywords = $request->getPost('keywords');

            // Lakukan validasi atau operasi lainnya sesuai kebutuhan

            // Simpan data ke database
            $data = [
                'alamat_toko' => $alamat_toko,
                'facebook' => $facebook,
                'youtube' => $youtube,
                'email' => $email,
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
            ];

            // Jika logo diunggah, simpan ke direktori dan tambahkan nama file ke $data
            if ($logo->isValid() && !$logo->hasMoved()) {
                $logo->move(ROOTPATH . 'public/images', $logo->getName());
                $data['logo'] = $logo->getName();
            }

            // Jika favicon diunggah, simpan ke direktori dan tambahkan nama file ke $data
            if ($favicon->isValid() && !$favicon->hasMoved()) {
                $favicon->move(ROOTPATH . 'public/images', $favicon->getName());
                $data['favicon'] = $favicon->getName();
            }

            $success = $this->metaModel->update($id_meta, $data);
 
            if ($success) {
                $response = ['status' => 'success', 'message' => 'Data berhasil diperbarui...!'];
            } else {
                $response = ['status' => 'error', 'message' => 'Gagal memperbarui data..!'];
            }
            
            // Menggunakan return untuk mengirimkan response sebagai JSON
            echo json_encode($response);
            
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to('Dashboard');
        }
    }
}
