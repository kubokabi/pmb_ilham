<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin', function () {
    return view('loginAdmin');
});
$routes->post('/loginAdmin', 'Auth::loginAdmin');

$routes->get('/', 'Home::index');
$routes->get('/prosedur', 'Home::prosedur');
$routes->get('/profil', 'Home::profil');
$routes->get('/kontak', 'Home::kontak');

$routes->post('register', 'Auth::register');
$routes->post('/loginWarga', 'Auth::loginWarga');
$routes->get('/logout', 'Auth::logout');

$routes->group('Warga', ['filter' => 'role:warga'], function ($routes) {
    $routes->get('/', 'Warga::index');

    // profil 
    $routes->get('profil', 'Warga::profil');
    $routes->post('updateProfil', 'Warga::updateProfil');
    $routes->post('changePassword', 'Warga::changePassword');

    // surat
    $routes->get('pengajuanSurat', 'Warga::pengajuanSurat');
    $routes->get('pengajuanSurat/create', 'Warga::create');
    $routes->post('pengajuanSurat/create', 'Warga::create');
    $routes->get('pengajuanSurat/edit/(:num)', 'Warga::edit/$1');
    $routes->post('pengajuanSurat/edit/(:num)', 'Warga::edit/$1');
    $routes->get('pengajuanSurat/delete/(:num)', 'Warga::delete/$1');
    $routes->post('pengajuanSurat/kirim/(:num)', 'Warga::kirim/$1');
    $routes->post('kirimPerbaikan/(:num)', 'Warga::kirimPerbaikan/$1');

    $routes->get('historySurat', 'Warga::historySurat'); // History Surat
});

$routes->group('Petugas', ['filter' => 'role:petugas'], function ($routes) {
    $routes->get('/', 'Petugas::index'); // Dashboard
    $routes->get('dataWarga', 'Petugas::dataWarga'); // Data Warga

    $routes->get('permintaanSurat', 'Petugas::permintaanSurat');
    $routes->post('permintaanSurat/suratDibuat', 'Petugas::suratDibuat');
    $routes->get('permintaanSurat/download/(:num)', 'Petugas::download/$1');

    $routes->get('laporanSurat', 'Petugas::laporanSurat'); // Laporan Surat
    $routes->post('laporan/getDataByMonth', 'Petugas::getDataByMonth');
    $routes->get('laporan/cetak', 'Petugas::cetakLaporan');

    // Akun Warga
    $routes->get('kelolaAkunWarga', 'Petugas::akunWarga');
    $routes->get('aktifkanAkun/(:num)', 'Petugas::aktifkanAkun/$1');
    $routes->get('nonaktifkanAkun/(:num)', 'Petugas::nonaktifkanAkun/$1');
    $routes->get('validasiAkun/(:num)', 'Petugas::validasiAkun/$1');
    $routes->get('deleteAkun/(:num)', 'Petugas::deleteAkun/$1');
    $routes->get('ubahPassword/(:num)', 'Petugas::ubahPassword/$1');
    $routes->post('updatePassword/(:num)', 'Petugas::updatePassword/$1');

    $routes->get('suratSelesai', 'Petugas::suratSelesai');
    $routes->get('permintaanSurat/delete/(:num)', 'Petugas::delete/$1');

    $routes->post('penolakanSurat', 'Petugas::penolakanSurat');
});

$routes->group('Kepala', ['filter' => 'role:kepala'], function ($routes) {
    $routes->get('/', 'Kepala::index');

    ## kelola akun warga
    $routes->get('kelolaAkunWarga', 'Kepala::akunWarga');
    $routes->get('ubahPassword/(:num)', 'Kepala::ubahPassword/$1');
    $routes->post('updatePassword/(:num)', 'Kepala::updatePassword/$1');

    ## Kelola akun petugas
    $routes->get('kelolaAkunPetugas', 'Kepala::AkunPetugas');
    $routes->get('tambahAkunPetugas', 'Kepala::tambahAkunPetugas'); // Form tambah akun petugas
    $routes->post('tambahAkunPetugas', 'Kepala::tambahAkunPetugas'); // Aksi tambah akun petugas
    $routes->get('editAkunPetugas/(:num)', 'Kepala::editAkunPetugas/$1'); // Form edit akun petugas
    $routes->post('editAkunPetugas/(:num)', 'Kepala::editAkunPetugas/$1'); // Aksi edit akun petugas
    $routes->get('deleteAkunPetugas/(:num)', 'Kepala::deleteAkunPetugas/$1'); // Aksi hapus akun petugas

    ## data Surat
    $routes->get('dataSurat', 'Kepala::dataSurat');

    ## laporan
    $routes->get('laporanSurat', 'Kepala::laporanSurat'); // Laporan Surat
    $routes->post('laporan/getDataByMonth', 'Kepala::getDataByMonth');
    $routes->get('laporan/cetak', 'Kepala::cetakLaporan');
});


// Jika route tidak ada akan di alihkan 
$routes->set404Override(function () {
    echo view('error');
});
