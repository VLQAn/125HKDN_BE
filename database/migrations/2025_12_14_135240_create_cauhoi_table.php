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
        Schema::create('cauhoi', function (Blueprint $table) {
            $table->bigIncrements('ID_Cau');
            $table->unsignedBigInteger('ID_BaiHoc');
            $table->string('LoaiCauHoi', 100);
            $table->integer('ThuTu');
            $table->timestamps();
            $table->foreign('ID_BaiHoc')
                  ->references('ID_BaiHoc')
                  ->on('baihoc')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cauhoi');
    }
};
