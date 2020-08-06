<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for dates.
 */
class CreateDatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Dates for the lessons.
		 */
		Schema::create('dates', function (Blueprint $table) {
			/* Date's id */
            $table->id();
			/* Indicate if the lesson is a face to face */
			$table->boolean('presentiel');
			/* IThe date */
			$table->date('date');
        });

		/**
		 * linking table between lessons and dates
		 */
		Schema::create('dates_cours', function (Blueprint $table) {
			/* The link's id */
            $table->id();
			/* The lesson's id */
			$table->BigInteger('cours_id')->unsigned();
			/* The date's id */
			$table->BigInteger('date_id')->unsigned();
			/* Indicate that "cours_id" is a foreign key linked to
			lesson's id */
			$table->foreign('cours_id')
                ->references('id')
                ->on('cours')
				->onDelete('cascade');
			/* Indicate that "date_id" is a foreign key linked to
			date's id */
			$table->foreign('date_id')
                ->references('id')
                ->on('dates')
				->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('dates');
		Schema::dropIfExists('dates_cours');
    }
}
