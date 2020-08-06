<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for lessons.
 */
class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Table for lessons.
		 */
        Schema::create('cours', function (Blueprint $table) {
			/* Lesson's id */
            $table->id();
			/* Lesson's title */
			$table->string('title');
			/* Lesson's description */
			$table->text('desc');
			/* Lesson's links */
			$table->json('links')->nullable();
			/* Lesson's images */
			$table->json('image')->nullable();
        });

		/**
		 * linking table between lessons and users
		 */
		Schema::create('cours_createurs', function (Blueprint $table) {
			/* link's id */
            $table->id();
			/* user's id */
			$table->BigInteger('user_id')->unsigned();
			/* lesson's id */
			$table->BigInteger('cours_id')->unsigned();
			/* Indicate that "user_id" is a foreign key linked to user's id */
			$table->foreign('user_id')
                ->references('id')
                ->on('users')
				->onDelete('cascade');
			/* Indicate that "cours_id" is a foreign key linked to
			lesson's id */
			$table->foreign('cours_id')
                ->references('id')
                ->on('cours')
				->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cours');
        Schema::dropIfExists('cours_createurs');
    }
}
