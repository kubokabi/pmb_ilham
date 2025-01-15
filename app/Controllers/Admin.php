<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InformasiModel;
use App\Models\FakultasModel;
use App\Models\ProdiModel;
use App\Models\PendaftaranModel;

class Admin extends BaseController
{
    public function index()
    {
        return view('Admin/dashboard');
    }

    // data pendaftaran
    public function dataPendaftaran()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil semua data pendaftaran dengan join tabel fakultas dan prodi
        $pendaftarans = $pendaftaranModel
            ->select('pendaftaran.*, fakultas.nama_fakultas, prodi.nama_prodi')
            ->join('fakultas', 'fakultas.id_fakultas = pendaftaran.id_fakultas', 'left')
            ->join('prodi', 'prodi.id_prodi = pendaftaran.id_prodi', 'left')
            ->findAll();

        $hasData = !empty($pendaftarans);

        return view('Admin/dataPendaftaran', [
            'pendaftarans' => $pendaftarans,
            'hasData' => $hasData, // Flag untuk mendeteksi ada/tidaknya data
        ]);
    }

    public function updatePendaftaranStatus()
    {
        date_default_timezone_set('Asia/Jakarta');

        $pendaftaranModel = new \App\Models\PendaftaranModel();
        // Ambil data dari input
        $data = [
            'id' => $this->request->getPost('id_pendaftaran'),
            'status_verifikasi' => $this->request->getPost('status_verifikasi'),
            'status_pendaftaran' => $this->request->getPost('status_pendaftaran'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        // Validasi input
        $rules = [
            'status_verifikasi' => 'required|in_list[unverified,verified]',
            'status_pendaftaran' => 'required|in_list[pending,approved,rejected]',
            'id_pendaftaran' => 'required|numeric'
        ];
        $messages = [
            'status_verifikasi' => [
                'required' => 'Status verifikasi harus dipilih.',
                'in_list' => 'Status verifikasi tidak valid.',
            ],
            'status_pendaftaran' => [
                'required' => 'Status pendaftaran harus dipilih.',
                'in_list' => 'Status pendaftaran tidak valid.',
            ],
            'id_pendaftaran' => [
                'required' => 'ID pendaftaran tidak ditemukan.',
                'numeric' => 'ID pendaftaran tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->with('error', 'Data tidak valid. Mohon periksa kembali.');
        }

        $idPendaftaran = $this->request->getPost('id_pendaftaran');

        // Update data di database
        if ($pendaftaranModel->update($idPendaftaran, $data)) {
            return redirect()->to('/Admin/data-pendaftaran')->with('success', 'Status berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui status.');
        }
    }


    // prodi
    public function dataProdi($id_fakultas)
    {
        $prodiModel = new ProdiModel();
        $fakultasModel = new FakultasModel();

        // Ambil data fakultas
        $fakultas = $fakultasModel->find($id_fakultas);
        if (!$fakultas) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Fakultas tidak ditemukan');
        }

        // Ambil semua prodi berdasarkan fakultas
        $prodi = $prodiModel->where('id_fakultas', $id_fakultas)->findAll();

        return view('Admin/prodi', [
            'fakultas' => $fakultas,
            'prodi' => $prodi,
        ]);
    }

    public function createProdi()
    {
        $prodiModel = new ProdiModel();
        $data = [
            'id_fakultas' => $this->request->getPost('id_fakultas'),
            'nama_prodi' => $this->request->getPost('nama_prodi'),
        ];
        $prodiModel->insert($data);

        return redirect()->back()->with('success', 'Prodi berhasil ditambahkan');
    }

    public function updateProdi($id_prodi)
    {
        $prodiModel = new ProdiModel();
        $data = [
            'nama_prodi' => $this->request->getPost('nama_prodi'),
        ];
        $prodiModel->update($id_prodi, $data);

        return redirect()->back()->with('success', 'Prodi berhasil diperbarui');
    }

    public function deleteProdi($id_prodi)
    {
        $prodiModel = new ProdiModel();
        $prodiModel->delete($id_prodi);

        return redirect()->back()->with('success', 'Prodi berhasil dihapus');
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
