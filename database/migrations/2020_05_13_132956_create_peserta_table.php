<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_peserta');
            $table->string('asal_sekolah')->nullable();
            $table->string('email_peserta')->unique();
            $table->date('mulai');
            $table->date('selesai');
            $table->bigInteger('lampiran_id')->unsigned();
            $table->foreign('lampiran_id')->references('id')->on('lampiran')->onDelete('cascade');
            $table->bigInteger('sekolah_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta');
    }
}
