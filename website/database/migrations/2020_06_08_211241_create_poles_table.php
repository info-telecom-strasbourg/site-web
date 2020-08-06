<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for poles.
 */
class CreatePolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Table for poles.
		 */
        Schema::create('poles', function (Blueprint $table) {
			/* The pole's id */
            $table->id();
			/* The pole's title */
            $table->string('title');
			/* The pole's slug */
            $table->string('slug');
			/* The pole's description */
            $table->text('desc');
            /* the poles images (in storage/images/poles folder) */
            $table->string('image');
			/* The pole's responsable's id */
            $table->BigInteger('respo_id')->unsigned();
			/* Indicate that "respo_id" is a foreign key linked to user's id */
            $table->foreign('respo_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('poles');
    }
}
