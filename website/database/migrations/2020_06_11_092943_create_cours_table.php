<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->text('desc');
        });


		/**
		 * linking table between lessons and users to create the association between a lesson and a user
		 */
		Schema::create('cours_createurs', function (Blueprint $table) {
            $table->id();
			$table->BigInteger('user_id')->unsigned();
			$table->BigInteger('cours_id')->unsigned();

			$table->foreign('user_id')
                ->references('id')
                ->on('users');

			$table->foreign('cours_id')
                ->references('id')
                ->on('cours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cours');
        Schema::dropIfExists('cours_createurs');
    }
}
