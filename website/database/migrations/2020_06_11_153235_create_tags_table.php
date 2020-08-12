<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for Tags.
 */
class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Tags for the lessons.
		 */
		Schema::create('tags', function (Blueprint $table) {
            $table->id();
			$table->string('tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
