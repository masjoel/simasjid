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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('id_client', 50)->nullable();
            $table->string('nama_client', 50)->nullable();
            $table->string('nama_app', 50)->nullable();
            $table->string('versi_app', 30)->nullable();
            $table->string('desc_app', 250)->nullable();
            $table->string('alamat_client', 200)->nullable();
            $table->string('signature', 100)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('logo', 250)->nullable();
            $table->dateTime('jam')->nullable();
            $table->string('mcad', 100)->nullable();
            $table->string('init', 100)->nullable();
            $table->string('bank', 150)->nullable();
            $table->string('footnot', 250)->nullable();
            $table->integer('provinsi_id')->nullable();
            $table->integer('kabupaten_id')->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->integer('kelurahan_id')->nullable();
            $table->tinyInteger('jdigit')->default(0);
            $table->tinyInteger('jdelay')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
