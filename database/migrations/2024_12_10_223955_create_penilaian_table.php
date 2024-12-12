<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Menyimpan id siswa
            $table->enum('sikap', ['baik', 'cukup baik', 'sangat baik']);
            $table->enum('microteaching', ['baik', 'cukup baik', 'sangat baik']); 
            $table->enum('kehadiran', ['baik', 'cukup baik', 'sangat baik']); 
            $table->enum('project', ['baik', 'cukup baik', 'sangat baik']); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
};

