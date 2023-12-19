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
        // koordinator atau dante
        Schema::table('dantes', function (Blueprint $table) {
            $table->string('tipe')->after('avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dantes', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }
};
