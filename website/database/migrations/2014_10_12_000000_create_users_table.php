<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for user table.
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Table for users.
		 */
        Schema::create('users', function (Blueprint $table) {
			/* The user's id */
            $table->id();
			/* The user's name */
            $table->string('name');
			/* The user's role */
            $table->BigInteger('role_id')->unsigned();
			/* The user's email */
            $table->string('email')->unique();
			/* The date when the email was verified */
            $table->timestamp('email_verified_at')->nullable();
			/* The user's password (it while be crypted) */
            $table->string('password');
			/* The user's profile picture (it's path) */
            $table->string('profil_picture')->nullable();
			/* The user's token */
            $table->rememberToken();
			/* The date of inscription of the user */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
