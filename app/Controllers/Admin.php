<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InformasiModel;
use App\Models\FakultasModel;

class Admin extends BaseController
{
    public function index()
    {
        return view('Admin/dashboard');
    }

    // fakultas
    public function fakultas()
    {
        $fakultasModel = new FakultasModel();
        $data['fakultas'] = $fakultasModel->findAll();
        return view('Admin/fakultas', $data);
    }
    public function saveFakultas()
    {
        $fakultasModel = new FakultasModel();
        $id = $this->request->getPost('id_fakultas');

        $data = [
            'nama_fakultas' => $this->request->getPost('nama_fakultas'),
        ];

        if ($id) {
            $fakultasModel->update($id, $data);
            return redirect()->to(base_url('Admin/data-fakultas'))->with('success', 'Data fakultas berhasil diperbarui.');
        } else {
            $fakultasModel->insert($data);
            return redirect()->to(base_url('Admin/data-fakultas'))->with('success', 'Data fakultas berhasil ditambahkan.');
        }
    }

    public function deleteFakultas($id)
    {
        $fakultasModel = new FakultasModel();

        if ($fakultasModel->delete($id)) {
            return redirect()->to(base_url('Admin/data-fakultas'))->with('success', 'Data fakultas berhasil dihapus.');
        } else {
            return redirect()->to(base_url('Admin/data-fakultas'))->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }


    // informasi
    public function informasi()
    {
        $informasiModel = new InformasiModel();
        $data['informasi'] = $informasiModel->findAll();
        return view('Admin/informasi', $data);
    }

    public function updateInformasi()
    {
        $informasiModel = new InformasiModel();

        $id = $this->request->getPost('id_informasi');
        $data = [
            'tgl_buka' => $this->request->getPost('tgl_buka'),
            'tgl_tutup' => $this->request->getPost('tgl_tutup'),
            'tgl_pengumuman' => $this->request->getPost('tgl_pengumuman'),
        ];

        if ($informasiModel->update($id, $data)) {
            return redirect()->to(base_url('Admin/informasi'))->with('success', 'Data berhasil diperbarui');
        } else {
            return redirect()->to(base_url('Admin/informasi'))->with('error', 'Data gagal diperbarui');
        }
    }
}
