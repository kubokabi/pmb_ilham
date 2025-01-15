<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendaftaranModel;

class CalonMahasiswa extends BaseController
{
    private $pendaftaran;

    public function __construct()
    {
        $this->pendaftaran = new PendaftaranModel();
    }

    public function index()
    {
        $data = $this->getPendaftaran();
        // Cek apakah semua tahap sebelumnya selesai
        if (!$data || $data['tahap_satu'] != 1 || $data['tahap_dua'] != 1 || $data['tahap_tiga'] != 1) {
            return redirect()->to('/CalonMahasiswa/tahaptiga')->with('error', 'Anda harus menyelesaikan semua tahap sebelumnya terlebih dahulu.');
        }

        $fakultasModel = new \App\Models\FakultasModel();
        $prodiModel = new \App\Models\ProdiModel();

        // Ambil nama fakultas dan prodi berdasarkan ID
        $fakultas = $fakultasModel->find($data['id_fakultas']);
        $prodi = $prodiModel->find($data['id_prodi']);

        // Tambahkan nama fakultas dan prodi ke data pendaftaran
        $data['nama_fakultas'] = $fakultas ? $fakultas['nama_fakultas'] : '-';
        $data['nama_prodi'] = $prodi ? $prodi['nama_prodi'] : '-';

        return view('CalonMahasiswa/dashboard', ['pendaftaran' => $data]);
    }

    // tahap satu
    public function tahapSatu()
    {
        $data = $this->getPendaftaran();

        // Jika tahap satu sudah selesai, arahkan ke tahap dua
        if ($data && $data['tahap_satu'] == 1) {
            return redirect()->to('/CalonMahasiswa/tahapdua')->with('success', 'Tahap Satu sudah selesai. Silakan lanjut ke Tahap Dua.');
        }

        return view('CalonMahasiswa/tahapSatu', ['pendaftaran' => $data]);
    }

    public function saveTahapSatu()
    {
        date_default_timezone_set('Asia/Jakarta');

        $pendaftaranModel = new \App\Models\PendaftaranModel();

        // Aturan validasi
        $rules = [
            'nama_peserta' => 'required|min_length[3]|max_length[100]',
            'tempat_lahir' => 'required|max_length[100]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[Laki-Laki,Perempuan]',
            'agama' => 'required|max_length[50]',
            'no_hp' => 'required|min_length[10]|max_length[15]|numeric',
            'alamat_peserta' => 'required|max_length[255]',
            'nama_orangtua' => 'required|max_length[100]',
            'pekerjaan_orangtua' => 'required|max_length[100]',
            'nama_sekolah' => 'required|max_length[100]',
            'tahun_lulus' => 'required|numeric|exact_length[4]',
            'alamat_sekolah' => 'required|max_length[255]',
        ];

        // Pesan validasi custom
        $messages = [
            'nama_peserta' => [
                'required' => 'Nama lengkap wajib diisi.',
                'min_length' => 'Nama lengkap minimal 3 karakter.',
                'max_length' => 'Nama lengkap maksimal 100 karakter.'
            ],
            'tempat_lahir' => [
                'required' => 'Tempat lahir wajib diisi.',
                'max_length' => 'Tempat lahir maksimal 100 karakter.'
            ],
            'tanggal_lahir' => [
                'required' => 'Tanggal lahir wajib diisi.',
                'valid_date' => 'Format tanggal lahir tidak valid.'
            ],
            'jenis_kelamin' => [
                'required' => 'Jenis kelamin wajib dipilih.',
                'in_list' => 'Jenis kelamin hanya bisa Laki-laki atau Perempuan.'
            ],
            'agama' => [
                'required' => 'Agama wajib diisi.',
                'max_length' => 'Agama maksimal 50 karakter.'
            ],
            'no_hp' => [
                'required' => 'Nomor handphone wajib diisi.',
                'min_length' => 'Nomor handphone minimal 10 digit.',
                'max_length' => 'Nomor handphone maksimal 15 digit.',
                'numeric' => 'Nomor handphone harus berupa angka.'
            ],
            'alamat_peserta' => [
                'required' => 'Alamat wajib diisi.',
                'max_length' => 'Alamat maksimal 255 karakter.'
            ],
            'nama_orangtua' => [
                'required' => 'Nama orang tua wajib diisi.',
                'max_length' => 'Nama orang tua maksimal 100 karakter.'
            ],
            'pekerjaan_orangtua' => [
                'required' => 'Pekerjaan orang tua wajib diisi.',
                'max_length' => 'Pekerjaan orang tua maksimal 100 karakter.'
            ],
            'nama_sekolah' => [
                'required' => 'Nama sekolah wajib diisi.',
                'max_length' => 'Nama sekolah maksimal 100 karakter.'
            ],
            'tahun_lulus' => [
                'required' => 'Tahun lulus wajib diisi.',
                'numeric' => 'Tahun lulus harus berupa angka.',
                'exact_length' => 'Tahun lulus harus terdiri dari 4 digit.'
            ],
            'alamat_sekolah' => [
                'required' => 'Alamat sekolah wajib diisi.',
                'max_length' => 'Alamat sekolah maksimal 255 karakter.'
            ],
        ];

        // Jika validasi gagal
        if (!$this->validate($rules, $messages)) {
            $errors = $this->validator->getErrors();
            $errorMessages = implode('\n', $errors);

            // Redirect kembali dengan pesan error
            return redirect()->back()->withInput()->with('error', $errorMessages);
        }

        // Ambil tahun dan bulan saat ini
        $tahun = date('Y');
        $bulan = date('m');

        // Hitung urutan terakhir di tabel pendaftaran
        $lastRecord = $pendaftaranModel->orderBy('id', 'DESC')->first();
        $lastUrutan = $lastRecord ? substr($lastRecord['nomor_pendaftaran'], -3) : 0;
        $newUrutan = str_pad($lastUrutan + 1, 3, '0', STR_PAD_LEFT); // Urutan dengan 3 digit

        // Nomor pendaftaran dengan format tahunbulan00urutan
        $nomorPendaftaran = $tahun . $bulan . '00' . $newUrutan;

        // Data untuk disimpan
        $data = [
            'id_users' => session()->get('id_users'),
            'nomor_pendaftaran' => $nomorPendaftaran,
            'nama_peserta' => $this->request->getPost('nama_peserta'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat_peserta' => $this->request->getPost('alamat_peserta'),
            'nama_orangtua' => $this->request->getPost('nama_orangtua'),
            'pekerjaan_orangtua' => $this->request->getPost('pekerjaan_orangtua'),
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'tahun_lulus' => $this->request->getPost('tahun_lulus'),
            'alamat_sekolah' => $this->request->getPost('alamat_sekolah'),
            'tahap_satu' => 1,
        ];

        // Simpan data ke database
        $pendaftaranModel->insert($data);

        // Redirect ke tahap berikutnya dengan pesan sukses
        return redirect()->to('/CalonMahasiswa/tahapdua')->with('success', 'Tahap Satu berhasil disimpan. Nomor Pendaftaran Anda: ' . $nomorPendaftaran);
    }

    // tahap dua
    public function tahapDua()
    {
        $data = $this->getPendaftaran();

        // Cek apakah tahap satu selesai
        if (!$data || $data['tahap_satu'] != 1) {
            return redirect()->to('/CalonMahasiswa/tahapsatu')->with('error', 'Anda harus menyelesaikan Tahap Satu terlebih dahulu.');
        }

        // Jika tahap dua sudah selesai, arahkan ke tahap tiga
        if ($data['tahap_dua'] == 1) {
            return redirect()->to('/CalonMahasiswa/tahaptiga')->with('success', 'Tahap Dua sudah selesai. Silakan lanjut ke Tahap Tiga.');
        }

        // Ambil data Fakultas dan Prodi
        $fakultasModel = new \App\Models\FakultasModel();
        $prodiModel = new \App\Models\ProdiModel();

        $fakultas = $fakultasModel->findAll();
        $prodi = $prodiModel->findAll();

        // Kelompokkan Prodi berdasarkan Fakultas
        $prodiGrouped = [];
        foreach ($prodi as $p) {
            $prodiGrouped[$p['id_fakultas']][] = $p;
        }

        return view('CalonMahasiswa/tahapdua', [
            'pendaftaran' => $data,
            'fakultas' => $fakultas,
            'prodiGrouped' => $prodiGrouped,
        ]);
    }


    public function updateTahapDua()
    {
        // Validasi input
        $rules = [
            'id_fakultas' => 'required|numeric',
            'id_prodi' => 'required|numeric',
        ];
        $messages = [
            'id_fakultas' => [
                'required' => 'Fakultas harus dipilih.',
                'numeric' => 'Fakultas tidak valid.',
            ],
            'id_prodi' => [
                'required' => 'Program Studi harus dipilih.',
                'numeric' => 'Program Studi tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            $errors = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('error', implode('<br>', $errors));
        }

        // Update data pendaftaran
        $data = [
            'id_fakultas' => $this->request->getPost('id_fakultas'),
            'id_prodi' => $this->request->getPost('id_prodi'),
            'tahap_dua' => 1,
        ];

        $pendaftaranModel = new \App\Models\PendaftaranModel();
        $pendaftaranModel->where('id_users', session()->get('id_users'))->set($data)->update();

        return redirect()->to('/CalonMahasiswa/tahaptiga')->with('success', 'Tahap Dua berhasil disimpan. Lanjut ke Tahap Tiga.');
    }

    // tahap tiga
    public function tahapTiga()
    {
        $data = $this->getPendaftaran();

        // Cek apakah tahap satu dan dua selesai
        if (!$data || $data['tahap_satu'] != 1 || $data['tahap_dua'] != 1) {
            return redirect()->to('/CalonMahasiswa/tahapdua')->with('error', 'Anda harus menyelesaikan Tahap Satu dan Dua terlebih dahulu.');
        }

        // Jika tahap tiga sudah selesai, arahkan ke tahap empat
        if ($data['tahap_tiga'] == 1) {
            return redirect()->to('/CalonMahasiswa/tahapempat')->with('success', 'Tahap Satu, Dua dan Tiga sudah selesai. Silakan lanjut ke Tahap Empat (Akhir).');
        }

        return view('CalonMahasiswa/tahapTiga', ['pendaftaran' => $data]);
    }

    public function updateTahapTiga()
    {
        $foto = $this->request->getFile('foto');
        $berkas = $this->request->getFile('berkas');

        // Validasi file
        if (!$foto->isValid() || !$berkas->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid. Pastikan semua file diunggah dengan format yang benar.');
        }

        // Validasi ukuran file
        if ($foto->getSize() > 500 * 1024) { // Maksimum 500 KB
            return redirect()->back()->with('error', 'Ukuran file foto maksimal 500 KB.');
        }

        if ($berkas->getSize() > 2 * 1024 * 1024) { // Maksimum 2 MB
            return redirect()->back()->with('error', 'Ukuran file berkas maksimal 2 MB.');
        }

        // Validasi format file
        $allowedImageTypes = ['image/jpeg', 'image/png'];
        if (!in_array($foto->getMimeType(), $allowedImageTypes)) {
            return redirect()->back()->with('error', 'Format foto harus JPG atau PNG.');
        }

        if ($berkas->getMimeType() !== 'application/pdf') {
            return redirect()->back()->with('error', 'Format berkas harus PDF.');
        }

        // Generate nama file baru
        $data = [
            'foto' => $foto->getRandomName(),
            'berkas' => $berkas->getRandomName(),
            'tahap_tiga' => 1,
        ];

        // Pindahkan file ke direktori uploads
        $foto->move(FCPATH . 'uploads', $data['foto']);
        $berkas->move(FCPATH . 'uploads', $data['berkas']);

        // Update data ke database
        $pendaftaranModel = new \App\Models\PendaftaranModel();
        $pendaftaranModel->where('id_users', session()->get('id_users'))->set($data)->update();

        // Redirect dengan pesan sukses
        return redirect()->to('/CalonMahasiswa/tahapempat');
    }

    // tahap empat
    public function tahapEmpat()
    {
        $data = $this->getPendaftaran();

        // Cek apakah semua tahap sebelumnya selesai
        if (!$data || $data['tahap_satu'] != 1 || $data['tahap_dua'] != 1 || $data['tahap_tiga'] != 1) {
            return redirect()->to('/CalonMahasiswa/tahaptiga')->with('error', 'Anda harus menyelesaikan semua tahap sebelumnya terlebih dahulu.');
        }

        // Jika tahap empat sudah selesai, arahkan ke dashboard
        if ($data['tanggal_pendaftaran'] && $data['created_at']) {
            return redirect()->to('/CalonMahasiswa/dashboard')->with('success', 'Pendaftaran sudah selesai.');
        }

        $fakultasModel = new \App\Models\FakultasModel();
        $prodiModel = new \App\Models\ProdiModel();

        // Ambil nama fakultas dan prodi berdasarkan ID
        $fakultas = $fakultasModel->find($data['id_fakultas']);
        $prodi = $prodiModel->find($data['id_prodi']);

        // Tambahkan nama fakultas dan prodi ke data pendaftaran
        $data['nama_fakultas'] = $fakultas ? $fakultas['nama_fakultas'] : '-';
        $data['nama_prodi'] = $prodi ? $prodi['nama_prodi'] : '-';

        return view('CalonMahasiswa/tahapEmpat', ['pendaftaran' => $data]);
    }

    public function updateTahapEmpat()
    {
        // Generate nama file baru
        $data = [
            'tanggal_pendaftaran' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Update data ke database
        $pendaftaranModel = new \App\Models\PendaftaranModel();
        $pendaftaranModel->where('id_users', session()->get('id_users'))->set($data)->update();

        // Redirect dengan pesan sukses
        return redirect()->to('/CalonMahasiswa/dashboard')->with('success', 'Tahap Tiga berhasil disimpan. Lanjut ke Tahap Empat.');
    }

    private function getPendaftaran()
    {
        $idUsers = session()->get('id_users');
        return $this->pendaftaran->where('id_users', $idUsers)->first();
    }
}
