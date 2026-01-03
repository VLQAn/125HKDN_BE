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
        Schema::create('dientu', function (Blueprint $table) {
            $table->bigIncrements('ID_Cau');
            $table->text('CauHoi');
            $table->text('CauMau'); // Câu mẫu để điền từ
            $table->string('ManhGhepA', 900);
            $table->string('ManhGhepB', 900);
            $table->string('ManhGhepC', 900);
            $table->string('ManhGhepD', 900);
            $table->string('DapAnDung', 900); // Vị trí (A, B, C, D) cho mảnh ghép
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
        Schema::dropIfExists('dientu');
    }
};
