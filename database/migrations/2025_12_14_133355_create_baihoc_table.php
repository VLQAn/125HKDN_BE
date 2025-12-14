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
        Schema::create('baihoc', function (Blueprint $table) {
            $table->bigIncrements('ID_BaiHoc');
            $table->unsignedBigInteger('ID_Chuong');
            $table->string('TenBaiHoc', 100);
            $table->string('IconBaiHoc', 100);
            $table->integer('ThuTu');
            $table->timestamps();
            $table->foreign('ID_Chuong')
                  ->references('ID_Chuong')
                  ->on('chuong')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baihoc_');
    }
};
