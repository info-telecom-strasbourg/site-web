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
            $table->id();
            $table->string('role');
            $table->string('poste');
            $table->boolean('is_unique')->default(0);
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
