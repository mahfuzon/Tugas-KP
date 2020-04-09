<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableSekolah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_sekolah');
            $table->text('alamat_sekolah');
            $table->string('email_sekolah')->unique();
            $table->string('no_telepon_sekolah')->unique();
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
        Schema::dropIfExists('sekolah');
    }
}
