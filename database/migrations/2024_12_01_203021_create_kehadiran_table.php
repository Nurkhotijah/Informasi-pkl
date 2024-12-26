<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sekolah_id');
            $table->date('tanggal');
            $table->time('waktu_masuk')->nullable();
            $table->time('waktu_keluar')->nullable();
            $table->enum('status', ['hadir', 'izin', 'tidak hadir'])->default('hadir');
            $table->string('foto_masuk')->nullable(); // Foto saat masuk
            $table->string('foto_keluar')->nullable(); // Foto saat keluar
            $table->string('foto_izin')->nullable(); // File izin jika ada
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kehadiran');
    }
};
