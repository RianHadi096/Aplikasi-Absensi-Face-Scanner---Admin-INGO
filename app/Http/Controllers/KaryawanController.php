<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index(){
        //get all data karyawan
        $karyawans = Karyawan::all();
        return view('admin.karyawan', compact('karyawans'));
    }
}
