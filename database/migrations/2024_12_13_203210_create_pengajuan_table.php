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
            $table->unsignedBigInteger('id_pkl')->nullable();; // Add the id_pkl column
            $table->string('nama');
            $table->string('jurusan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('cv_file');
            $table->enum('status_persetujuan', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
    
            $table->foreign('id_sekolah')->references('id')->on('sekolah')->onDelete('cascade');
            $table->foreign('id_pkl')->references('id')->on('pkl')->onDelete('cascade'); // Add foreign key for id_pkl
        });
    
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
};