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
        //buat tabel users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();
            $table->rememberToken();
        });

        //buat kolom tambahan dengan create_profile_karyawan_id_foreign
        Schema::table('users',function (Blueprint $table){
            $table->unsignedBigInteger('profile_karyawan_id')->nullable();
            $table->foreign('profile_karyawan_id')->references('id')->on('profile_karyawan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //hapus tabel users
        Schema::dropIfExists('users');
    }
};
