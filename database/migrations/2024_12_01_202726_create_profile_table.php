<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->text('alamat')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('foto_profile')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('cv_file')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_sekolah')->references('id')->on('sekolah')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sekolah');
    }
};