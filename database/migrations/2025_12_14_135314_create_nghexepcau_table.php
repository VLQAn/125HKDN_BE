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
        Schema::create('nghexepcau', function (Blueprint $table) {
            $table->bigIncrements('ID_Cau');
            $table->string('DuongDanAudio', 255);
            $table->string('ManhGhepA', 255);
            $table->string('ManhGhepB', 255);
            $table->string('ManhGhepC', 255);
            $table->string('ManhGhepD', 255);
            $table->string('DapAnDung', 10);
            $table->timestamps();
            $table->foreign('ID_Cau')
                    ->references('ID_Cau')
                    ->on('cauhoi')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nghexepcau');
    }
};
