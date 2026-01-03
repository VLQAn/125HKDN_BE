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
        Schema::table('tracnghiem', function (Blueprint $table) {
            $table->string('DapAnDung', 900)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracnghiem', function (Blueprint $table) {
            $table->string('DapAnDung', 10)->change();
        });
    }
};
