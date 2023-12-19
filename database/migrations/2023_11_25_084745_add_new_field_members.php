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
        // tingkat : Nasional, Prov, Kab/Kota, Kec, Desa
        // Cara voting: - post - dropbox - tps - lainnya (input)
        Schema::table('members', function (Blueprint $table) {
            $table->string('passport')->after('nik')->unique();
            $table->string('tingkat')->after('image')->nullable();
            $table->string('simpul')->after('tingkat')->nullable();
            $table->string('negara')->after('simpul')->nullable();
            $table->string('kota')->after('negara')->nullable();
            $table->string('cara_voting')->after('kota')->nullable();
            $table->string('tipe')->after('cara_voting')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['passport', 'tingkat', 'simpul', 'negara', 'kota', 'cara_voting', 'tipe']);
        });
    }
};
