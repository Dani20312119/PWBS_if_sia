<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Karyawan extends Controller
{
    // buat fungsi index (tampil data karyawan)
    function index() {
        // echo "Halaman Tampil Data Karyawan";
        echo env("API_URL");
    }
}
