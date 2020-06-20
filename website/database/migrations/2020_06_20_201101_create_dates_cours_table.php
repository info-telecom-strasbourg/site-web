<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatesCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		/**
		 * Link dates and lessons
		 */
		Schema::create('dates_cours', function (Blueprint $table) {
            $table->id();
			$table->BigInteger('cours_id')->unsigned();
			$table->BigInteger('date_id')->unsigned();

			$table->foreign('cours_id')
                ->references('id')
                ->on('cours')
				->onDelete('cascade');

			$table->foreign('date_id')
                ->references('id')
                ->on('dates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dates_cours');
    }
}
