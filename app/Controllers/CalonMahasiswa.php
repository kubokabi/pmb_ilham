<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CalonMahasiswa extends BaseController
{
    public function index()
    {
        return view('CalonMahasiswa/dashboard');
    }
   
}