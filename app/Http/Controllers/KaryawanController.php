<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\RegisterUser;

class KaryawanController extends Controller
{
    public function index(){
        //get all data karyawan
        $karyawans = Karyawan::all();
        return view('admin.user_management', compact('karyawans'));
    }
    public function prosesTambahKaryawan(){
        //panggil model Karyawan
        $karyawan = new Karyawan();
        //request get data dari form tambah karyawan
        $karyawan::Create([
            'nama_lengkap' => request('nama_lengkap'),
            'tanggal_lahir' => request('tanggal_lahir'),
            'NIK' => request('NIK'),
            'bagian' => request('bagian'),
            'tanggal_masuk_kerja' => request('tanggal_masuk_kerja'),
            'nomor_handphone' => request('nomor_handphone'),
        ]);

        //membuat username dan password otomatis dari nama_lengkap
        $username = $this->generateUsername(request('nama_lengkap'));
        $password = 'ingoo123'; // Password default
        //simpan data user baru di tabel users
        $user = new RegisterUser();
        $user::Create([
            'name' => $username,
            'email' => $username . '@ingoo.test',
            'password' => bcrypt($password),
        ]);
        return redirect()->route('admin.karyawan')->with('message', 'Data Karyawan Berhasil Ditambahkan.');
    }
    private function generateUsername($namaLengkap)
    {
        // Hapus spasi dan ubah ke huruf kecil
        $username = strtolower(str_replace(' ', '', $namaLengkap));
        // Cek apakah username sudah ada di database
        $count = RegisterUser::where('name', 'LIKE', "{$username}%")->count();
        // Jika sudah ada, tambahkan angka di belakangnya
        if ($count > 0) {
            $username .= $count + 1;
        }
        return $username;
    }
    public function hapusKaryawan($id){
        //cari data karyawan berdasarkan id
        $karyawan = Karyawan::find($id);
        //hapus data karyawan
        $karyawan->delete();
        return redirect()->route('admin.karyawan')->with('message', 'Data Karyawan Berhasil Dihapus.');
    }
    public function prosesUpdateKaryawan(Request $request){
        //cari data karyawan berdasarkan id
        $karyawan = Karyawan::find($request->id);
        //update data karyawan
        $karyawan->update([
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'NIK' => $request->NIK,
            'bagian' => $request->bagian,
            'jabatan' => $request->jabatan,
            'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
            'nomor_handphone' => $request->nomor_handphone,
        ]);
        return redirect()->route('admin.karyawan')->with('message', 'Data Karyawan Berhasil Diupdate.');
    }
}
