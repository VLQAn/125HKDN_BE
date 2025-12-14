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
        Schema::create('tiendohoc', function (Blueprint $table) {
            $table->bigIncrements('ID_TienDo');
            $table->unsignedBigInteger('ID_User');
            $table->unsignedBigInteger('ID_BaiHoc');
            $table->string('TrangThai', 100);
            $table->timestamps();
            $table->foreign('ID_User')
                  ->references('ID_User')
                  ->on('user')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('tiendohoc');
    }
};
