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
        Schema::create('video', function (Blueprint $table) {
            $table->bigIncrements('ID_Cau');
            $table->string('DuongDanVideo', 255);
            $table->text('CauHoi');
            $table->string('DapAnA', 255);
            $table->string('DapAnB', 255);
            $table->string('DapAnC', 255);
            $table->string('DapAnD', 255);
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
        Schema::dropIfExists('video');
    }
};
