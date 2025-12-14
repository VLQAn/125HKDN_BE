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
        Schema::create('nghehoithoai', function (Blueprint $table) {
            $table->bigIncrements('ID_Cau');
            $table->string('DuongDanAudio', 255);
            $table->text('PhuDe')->nullable(); // Nội dung có thể null nếu không cần hiển thị
            $table->string('DapAnA', 255);
            $table->string('DapAnB', 255);
            $table->string('DapAnDung', 10); // Đáp án đúng (A, B,...)
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
        Schema::dropIfExists('nghehoithoai');
    }
};
