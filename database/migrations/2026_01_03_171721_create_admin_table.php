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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('ID_Admin');
            $table->string('TenDangNhap')->unique();
            $table->string('MatKhau');
            $table->string('HoTen');
            $table->timestamps();
        });

        // Insert default admin
        DB::table('admin')->insert([
            'TenDangNhap' => 'admin',
            'MatKhau' =>  Hash::make('123456'), // Default password
            'HoTen' => 'Administrator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
