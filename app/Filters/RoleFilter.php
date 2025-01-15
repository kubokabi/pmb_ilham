<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PendaftaranModel;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil data dari session
        $role = session()->get('role');

        // Jika pengguna tidak terautentikasi, redirect ke login
        if (!$role) {
            return redirect()->to('/login')->with('error', 'Silakan login untuk melanjutkan.');
        } 

        // Jika tidak ada argumen, izinkan akses
        if (!$arguments) {
            return;
        }

        // Periksa apakah peran pengguna termasuk dalam argumen yang diizinkan
        if (!in_array($role, $arguments)) {
            // Jika role tidak diizinkan, redirect ke dashboard masing-masing
            $dashboardPaths = [
                'admin' => 'Admin/dashboard',
                'calon' => 'logout',
            ];

            if (array_key_exists($role, $dashboardPaths)) {
                return redirect()->to(base_url($dashboardPaths[$role]));
            } else {
                // Jika peran tidak dikenal, redirect ke halaman utama
                return redirect()->to('/')->with('error', 'Akses tidak diizinkan.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu aksi setelah
    }
}
