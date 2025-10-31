<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi_karyawan', function (Blueprint $table) {
            //membuat kolom id,nama_karyawan,tanggal_absensi,waktu_absensi,status_absensi,koordinat(google_maps),created_at,updated_at
            $table->id();
            $table->string('nama_karyawan');
            $table->date('tanggal_absensi');
            $table->time('waktu_absensi');
            $table->string('status_absensi');
            $table->string('koordinat');
            $table->timestamps();

            //menghubungkan tabel profile_karyawan dengan tabel absensi_karyawan melalui kolom id_karyawan
            $table->unsignedBigInteger('id_karyawan');
            $table->foreign('id_karyawan')->references('id')->on('profile_karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_karyawan');
    }
};
