<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        // Load UserModel dan wargaModel
        $this->userModel = new UsersModel();

        // Start session
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('index');
    }

    public function login()
    {

        return view('login');
    }

    public function pendaftaran(): string
    {
        return view('pendaftaran');
    }

    public function calonDaftar()
    {
        date_default_timezone_set('Asia/Jakarta');
        $usersModel = new \App\Models\UsersModel();

        // Validasi input 
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];
        // Aturan validasi
        $messages = [
            'nama' => [
                'required' => 'Nama lengkap harus diisi.',
                'max_length' => 'Nama lengkap tidak boleh lebih dari 255 karakter.'
            ],
            'email' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Email harus berupa email yang valid.',
                'is_unique' => 'Email sudah digunakan, silakan gunakan email lain.',
            ],
            'password' => [
                'required' => 'Password wajib diisi.',
                'min_length' => 'Password harus memiliki minimal 6 karakter.',
            ],
            'confirm_password' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches' => 'Konfirmasi password harus sama dengan password.',
            ],
        ];

        // Jika validasi gagal
        if (!$this->validate($rules, $messages)) {
            // Kumpulkan pesan kesalahan
            $errors = $this->validator->getErrors();
            $errorMessages = implode('\n\n', $errors);

            // Kirim pesan kesalahan ke session
            return redirect()->to('/register')->withInput()->with('error', $errorMessages);
        }

        // Ambil data dari form
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash password
            'role' => 'calon', // Default role untuk pengguna baru
            'created_at' => date('Y-m-d H:i:s', time()), // Waktu sekarang
        ];

        // Simpan ke database
        $usersModel->insert($data);

        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function autentikasi()
    {
        // Validasi input
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, redirect kembali dengan error
            return redirect()->back()->withInput()->with('error', 'Mohon isi form dengan benar.');
        }

        // Ambil data dari form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari pengguna berdasarkan email
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            // Jika pengguna tidak ditemukan
            return redirect()->to('/login')->with('error', 'Email tidak terdaftar.');
        }

        // Verifikasi password
        if (!password_verify($password, $user['password'])) {
            // Jika password salah
            return redirect()->to('/login')->with('error', 'Password salah.');
        }

        // Atur data sesi
        $this->session->set([
            'id_users'   => $user['id_users'],
            'nama'   => $user['nama'],
            'role'       => $user['role'],
            'logged_in'  => true,
        ]);

        // Redirect berdasarkan role
        return $this->redirectBasedOnRole();
    }

    /**
     * Mengarahkan pengguna ke dashboard berdasarkan role
     */
    private function redirectBasedOnRole()
    {
        $role = $this->session->get('role');

        switch ($role) {
            case 'admin':
                return redirect()->to('Admin/dashboard');
            case 'calon':
                // Ambil data tahap dari database
                $pendaftaranModel = new \App\Models\PendaftaranModel();
                $pendaftaran = $pendaftaranModel->where('id_users', $this->session->get('id_users'))->first();

                if (!$pendaftaran) {
                    return redirect()->to('/CalonMahasiswa/tahapsatu');
                }

                // Logika tahap
                if ($pendaftaran['tahap_tiga'] == 1) {
                    return redirect()->to('/CalonMahasiswa/tahaptiga');
                } elseif ($pendaftaran['tahap_dua'] == 1) {
                    return redirect()->to('/CalonMahasiswa/tahapdua');
                } elseif ($pendaftaran['tahap_satu'] == 1) {
                    return redirect()->to('/CalonMahasiswa/tahapsatu');
                } elseif ($pendaftaran['created_at']) {
                    return redirect()->to('/CalonMahasiswa/dashboard');
                } else {
                    return redirect()->to('/CalonMahasiswa/tahapempat');
                }
            default:
                // Jika role tidak dikenali, logout
                return $this->logout();
        }
    }

    /**
     * Proses logout
     */
    public function logout()
    {
        // Hapus semua data sesi
        $this->session->destroy();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->to('/login');
    }
}
