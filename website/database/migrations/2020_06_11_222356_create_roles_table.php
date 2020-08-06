<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for tables linked to roles.
 */
class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Table of roles.
		 */
        Schema::create('roles', function (Blueprint $table) {
			/* Role's id */
            $table->id();
			/* Role's name */
            $table->string('role');
			/* associated post */
            $table->string('poste');
			/* Indicate if the role is unique */
            $table->boolean('is_unique')->default(0);
			/* Date of creation of the role */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
