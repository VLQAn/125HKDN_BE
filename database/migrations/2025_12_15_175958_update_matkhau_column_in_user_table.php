<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('MatKhau', 255)->change();
        });
    }

    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('MatKhau', 18)->change(); // trở về như trước
        });
    }
};
