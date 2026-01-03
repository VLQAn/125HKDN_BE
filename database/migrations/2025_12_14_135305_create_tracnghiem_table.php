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
        Schema::create('tracnghiem', function (Blueprint $table) {
            $table->bigIncrements('ID_Cau');
            $table->text('CauHoi');        
            $table->string('DapAnA', 900);
            $table->string('DapAnB', 900);
            $table->string('DapAnC', 900);
            $table->string('DapAnD', 900);
            $table->string('DapAnDung', 900); 
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
        Schema::dropIfExists('tracnghiem');
    }
};
