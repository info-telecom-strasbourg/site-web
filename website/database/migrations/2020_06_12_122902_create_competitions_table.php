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
            $table->id();
            $table->string('title');
            $table->text('desc');
            $table->string('cover')->nullable();
			$table->json('images')->nullable();
            $table->string('result')->nullable();
			$table->string('place')->nullable();
            $table->string('website');
        });

		/**
		 * Linking table between users and competitions.
		 */
		Schema::create('user_compet', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('competition_id')->unsigned();
			$table->unique(['user_id', 'competition_id']);

			$table->foreign('user_id')
                ->references('id')
                ->on('users')
				->onDelete('cascade');

			$table->foreign('competition_id')
                ->references('id')
                ->on('competitions')
				->onDelete('cascade');
        });

		/**
		 * Linking table between dates and competitions.
		 */
		Schema::create('dates_comp', function (Blueprint $table) {
			$table->id();
			$table->BigInteger('date_id')->unsigned();
			$table->BigInteger('competition_id')->unsigned();
			$table->foreign('competition_id')
                ->references('id')
                ->on('competitions')
				->onDelete('cascade');

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
