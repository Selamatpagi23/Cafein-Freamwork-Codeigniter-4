<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesanMasukModel;

class PesanMasuk extends BaseController
{
    protected $pesanMasukModel;

    public function __construct()
    {
        $this->pesanMasukModel = new PesanMasukModel();
    }
    public function index()
    {
        return view('pesan');
    }

    public function dataPesanMasuk()
    {
        $pesanMasuk = $this->pesanMasukModel->findAll();
        echo json_encode($pesanMasuk);
    }

    public function updateStatus()
    {
        $request = $this->request;
        $id_pesanMasuk = $request->getPost('id_pesanMasuk');
        $newStatus = $request->getPost('status');
        $waktu_bayar = $request->getPost('waktu_bayar');

        // Mengambil data pesanMasuk yang sudah ada
        $existingData = $this->pesanMasukModel->find($id_pesanMasuk);

        // Periksa apakah data ditemukan
        if (!$existingData) {
            $response = ['error' => false, 'message' => 'Data tidak ditemukan.'];
            return $this->response->setJSON($response);
        }

        // Lakukan operasi pembaruan hanya jika status atau waktu_bayar berubah
        if ($existingData['status'] !== $newStatus || $existingData['waktu_bayar'] !== $waktu_bayar) {
            $data = [
                'id_pesanMasuk' => $id_pesanMasuk,
                'waktu_pesan' => $existingData['waktu_pesan'],
                'nama_user' => $existingData['nama_user'],
                'email' => $existingData['email'],
                'jenis_member' => $existingData['jenis_member'],
                'bulan' => $existingData['bulan'],
                'user_id' => $existingData['user_id'],
                'status' => $newStatus,
                'waktu_bayar' => $waktu_bayar,
            ];

            // Gantilah dengan metode yang sesuai (replace) berdasarkan kebutuhan Anda
            $success = $this->pesanMasukModel->replace($data);

            if ($success) {
                $response = ['success' => true, 'message' => 'Status berhasil diperbarui.'];
            } else {
                $response = ['error' => false, 'message' => 'Gagal memperbarui status.'];
            }
        } else {
            $response = ['error' => false, 'message' => 'Tidak ada perubahan untuk diperbarui.'];
        }

        return $this->response->setJSON($response);
    }

    public function deletePesanMasuk()
    {
        $request = $this->request;
        $id_pesanMasuk = $request->getPost('id_pesanMasuk');

        // Menghapus data berdasarkan id_pesanMasuk
        $deleted = $this->pesanMasukModel->delete(['id_pesanMasuk' => $id_pesanMasuk]);

        if ($deleted) {
            $response = ['success' => true, 'message' => 'Data berhasil dihapus.'];
        } else {
            $response = ['error' => false, 'message' => 'Gagal menghapus data.'];
        }

        return $this->response->setJSON($response);
    }
}
