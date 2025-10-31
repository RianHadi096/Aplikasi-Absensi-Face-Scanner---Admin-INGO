<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiKaryawanController extends Controller
{
    public function historyAbsensi(){
        return view('admin.histori_absensi_karyawan');
    }
}
