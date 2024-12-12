<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->string('nama');
            $table->string('jurusan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('cv_file');
            $table->enum('status_persetujuan', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->integer('tahun');
            $table->string('pembimbing');
            $table->string('judul_pkl');
            $table->string('lampiran');
            $table->timestamps();

            $table->foreign('id_sekolah')->references('id')->on('sekolah')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
};