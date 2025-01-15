<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::login');
$routes->post('/autentikasi', 'Auth::autentikasi');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::pendaftaran');
$routes->post('/register', 'Auth::calonDaftar');

$routes->group('Admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::index');

    // data pendaftaran
    $routes->get('data-pendaftaran', 'Admin::dataPendaftaran');
    $routes->post('updatePendaftaranStatus', 'Admin::updatePendaftaranStatus');

    //prodi 
    $routes->get('data-prodi/(:num)', 'Admin::dataProdi/$1');
    $routes->post('data-prodi/create', 'Admin::createProdi');
    $routes->post('data-prodi/update/(:num)', 'Admin::updateProdi/$1');
    $routes->post('data-prodi/delete/(:num)', 'Admin::deleteProdi/$1');

    // fakultas
    $routes->get('data-fakultas', 'Admin::fakultas');
    $routes->post('saveFakultas', 'Admin::saveFakultas');
    $routes->post('deleteFakultas/(:num)', 'Admin::deleteFakultas/$1');

    // informasi
    $routes->get('informasi', 'Admin::informasi');
    $routes->post('updateInformasi', 'Admin::updateInformasi');
});

$routes->group('CalonMahasiswa', ['filter' => 'role:calon'], function ($routes) {
    $routes->get('dashboard', 'CalonMahasiswa::index');

    $routes->get('tahapsatu', 'CalonMahasiswa::tahapSatu');
    $routes->get('tahapdua', 'CalonMahasiswa::tahapDua');
    $routes->get('tahaptiga', 'CalonMahasiswa::tahapTiga');
    $routes->get('tahapempat', 'CalonMahasiswa::tahapEmpat');

    $routes->post('saveTahapSatu', 'CalonMahasiswa::saveTahapSatu');
    $routes->post('updateTahapDua', 'CalonMahasiswa::updateTahapDua');
    $routes->post('updateTahapTiga', 'CalonMahasiswa::updateTahapTiga');
    $routes->post('updateTahapEmpat', 'CalonMahasiswa::updateTahapEmpat');
});
