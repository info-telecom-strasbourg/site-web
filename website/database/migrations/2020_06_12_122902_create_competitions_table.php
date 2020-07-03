<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

		Schema::create('user_compet', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('competition_id')->unsigned();

			$table->foreign('user_id')
                ->references('id')
                ->on('users')
				->onDelete('cascade');

			$table->foreign('competition_id')
                ->references('id')
                ->on('competitions')
				->onDelete('cascade');
        });

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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitions');
        Schema::dropIfExists('user_compet');
        Schema::dropIfExists('dates_comp');
    }
}
