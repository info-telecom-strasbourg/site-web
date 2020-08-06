<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration to give the possibility to reset the password.
 */
class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Table for password reset.
		 */
        Schema::create('password_resets', function (Blueprint $table) {
			/* The user's email */
            $table->string('email')->index();
			/* The user's token */
            $table->string('token');
			/* The user's date of inscription */
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
