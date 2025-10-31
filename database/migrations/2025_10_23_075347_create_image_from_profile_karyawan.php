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
        //membuat kolom imageFileLocation di tabel profile_karyawan
        Schema::table('profile_karyawan', function (Blueprint $table) {
            $table->string('imageFileLocation')->after('nomor_handphone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //menghapus kolom imageFileLocation di tabel profile_karyawan
        Schema::table('profile_karyawan', function (Blueprint $table) {
            $table->dropColumn('imageFileLocation');
        });
    }
};
