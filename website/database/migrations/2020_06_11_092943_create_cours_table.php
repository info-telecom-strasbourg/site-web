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
            $table->string('link_support')->nullable();
        });

		/* linking table between lessons and users to create the association between a lesson and a user */
		Schema::create('cours_createurs', function (Blueprint $table) {
            $table->id();
			$table->BigInteger('user_id')->unsigned();
			$table->BigInteger('cours_id')->unsigned();

			$table->unique('user_id', 'cours_id');

			$table->foreign('user_id')
                ->references('id')
                ->on('users');

			$table->foreign('cours_id')
                ->references('id')
                ->on('cours');
        });

		/* Link references and lessons */
		Schema::create('references', function (Blueprint $table) {
            $table->id();
			$table->string('ref');
			$table->BigInteger('cours_id')->unsigned();

			$table->unique('ref', 'cours_id');

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
    }
}
