<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for tables linked to competitions.
 */
class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Table for competitions.
		 */
        Schema::create('competitions', function (Blueprint $table) {
			/* Competition's id */
            $table->id();
			/* Competition's title */
            $table->string('title');
			/* Competition's description */
            $table->text('desc');
			/* Competition's images */
            $table->json('images')->nullable();
			/* Competition's results */
            $table->string('result')->nullable();
			/* Competition's website */
            $table->string('website');
        });

		/**
		 * Linking table between users and competitions.
		 */
		Schema::create('user_compet', function (Blueprint $table) {
			/* Link's id */
            $table->id();
			/* User's id */
            $table->BigInteger('user_id')->unsigned();
			/* Competition's id */
            $table->BigInteger('competition_id')->unsigned();
			/* Indicate that "user_id" is a foreign key linked to user's id */
			$table->foreign('user_id')
                ->references('id')
                ->on('users')
				->onDelete('cascade');
			/* Indicate that "competition_id" is a foreign key linked to
			competition's id */
			$table->foreign('competition_id')
                ->references('id')
                ->on('competitions')
				->onDelete('cascade');
        });

		/**
		 * Linking table between dates and competitions.
		 */
		Schema::create('dates_comp', function (Blueprint $table) {
			/* Link's id */
			$table->id();
			/* Date's id */
			$table->BigInteger('date_id')->unsigned();
			/* Competition's id */
			$table->BigInteger('competition_id')->unsigned();
			/* Indicate that "competition_id" is a foreign key linked to
			competition's id */
			$table->foreign('competition_id')
                ->references('id')
                ->on('competitions')
				->onDelete('cascade');
			/* Indicate that "date_id" is a foreign key linked to date's id */
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
        Schema::dropIfExists('competitions');
        Schema::dropIfExists('user_compet');
        Schema::dropIfExists('dates_comp');
    }
}
