<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::login');
$routes->post('/autentikasi', 'Auth::autentikasi');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::pendaftaran');

$routes->get('/admin', 'Admin::index');

$routes->group('Admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::index');

    // fakultas
    $routes->get('data-fakultas', 'Admin::fakultas');
    $routes->post('saveFakultas', 'Admin::saveFakultas');
    $routes->post('deleteFakultas/(:num)', 'Admin::deleteFakultas/$1');

    // informasi
    $routes->get('informasi', 'Admin::informasi');
    $routes->post('updateInformasi', 'Admin::updateInformasi');
});

$routes->group('CalonMahasiswa', ['filter' => 'role:calon'], function ($routes) {
    $routes->get('dashboard', 'CalonMahasiswa::index'); // Dashboard
   
});