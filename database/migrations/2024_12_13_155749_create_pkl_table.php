<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePklTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkl', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->integer('tahun');
            $table->string('pembimbing');
            $table->string('judul_pkl');
            $table->string('lampiran');
            $table->timestamps();
            
            $table->foreign('id_sekolah')->references('id')->on('sekolah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pkl');
    }
}
