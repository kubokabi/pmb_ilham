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

    public function login(){
        
        return view('login');
    }

    public function pendaftaran(): string
    {
        return view('pendaftaran');
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
                return redirect()->to('CalonMahasiswa/dashboard');
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