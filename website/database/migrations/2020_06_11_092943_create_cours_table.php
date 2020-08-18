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
            $table->id();
			$table->string('title');
			$table->text('desc');
			$table->json('links')->nullable();
			$table->json('images')->nullable();
        });

		/**
		 * linking table between lessons and users
		 */
		Schema::create('cours_createurs', function (Blueprint $table) {
            $table->id();
			$table->BigInteger('user_id')->unsigned();
			$table->BigInteger('cours_id')->unsigned();

			$table->foreign('user_id')
                ->references('id')
                ->on('users')
				->onDelete('cascade');
				
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
