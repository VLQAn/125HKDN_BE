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
        Schema::create('chonanh', function (Blueprint $table) {
            $table->bigIncrements('ID_Cau');
            $table->text('CauHoi'); // Câu hỏi thường dài
            $table->string('DuongDanA', 255); // Đường dẫn hình ảnh A
            $table->string('DuongDanB', 255); // Đường dẫn hình ảnh B
            $table->string('DuongDanC', 255); // Đường dẫn hình ảnh C
            $table->string('DuongDanD', 255); // Đường dẫn hình ảnh D
            $table->string('DapAnDung', 10); // Lưu đáp án đúng (A, B, C, D)
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
        Schema::dropIfExists('chonanh');
    }
};
