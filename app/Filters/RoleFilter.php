<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil data dari session
        $role = session()->get('role');

        // Jika pengguna tidak terautentikasi, redirect ke login
        if (!$role) {
            return redirect()->to('/');
        }

        // Jika tidak ada argumen, izinkan akses
        if (!$arguments) {
            return;
        }

        // Periksa apakah peran pengguna termasuk dalam argumen yang diizinkan
        if (!in_array($role, $arguments)) {
            // Jika tidak diizinkan, redirect ke dashboard sesuai perannya
            $dashboardPaths = [
                'warga' => 'Warga',
                'petugas' => 'Petugas',
            ];

            if (array_key_exists($role, $dashboardPaths)) {
                return redirect()->to(base_url($dashboardPaths[$role]));
            } else {
                // Jika peran tidak dikenal, redirect ke halaman utama
                return redirect()->to('/');
            }
        }

        // Jika peran diizinkan, lanjutkan permintaan
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu aksi setelah
    }
}
