<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Siguraduhin na 'users' ang table name
        Schema::table('users', function (Blueprint $table) {
            // Huwag lagyan ng 'if not exists' kung sigurado kang wala pa yung column
            $table->string('profile_picture')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_picture');
        });
    }
};