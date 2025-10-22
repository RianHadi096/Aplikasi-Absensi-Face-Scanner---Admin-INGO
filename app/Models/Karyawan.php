<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    //menyimpan data karyawan pada tabel profile_karyawan
    protected $table = 'profile_karyawan';
    protected $fillable = [
        'nama_lengkap',
        'tanggal_lahir',
        'NIK',
        'bagian',
        'tanggal_masuk_kerja',
        'nomor_handphone',
    ];
}
