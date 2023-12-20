<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('kk_id')->nullable();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('telpon')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('gender')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_keluarga')->nullable();
            $table->string('status_nikah')->nullable();
            $table->string('status_ekonomi')->nullable();
            $table->integer('provinsi_id')->nullable();
            $table->integer('kabupaten_id')->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->integer('kelurahan_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('image')->nullable();
            $table->enum('verified', ['unverified', 'verified'])->default('unverified');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penduduks');
    }
};

