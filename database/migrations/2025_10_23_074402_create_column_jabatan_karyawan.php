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
        //membuat tabel kolom jabatan_karyawan di tabel profile_karyawan
        Schema::table('profile_karyawan', function (Blueprint $table) {
            $table->string('jabatan', 50)->after('bagian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //menghapus kolom jabatan_karyawan di tabel profile_karyawan
        Schema::table('profile_karyawan', function (Blueprint $table) {
            $table->dropColumn('jabatan');;
        });
    }
};
