<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CalonMahasiswa extends BaseController
{
    public function index()
    {
        return view('CalonMahasiswa/index');
    }

    public function login()
    {
        return view('CalonMahasiswa/login');
    }

    public function pendaftaran()
    {
        return view('CalonMahasiswa/pendaftaran');
    }
}
