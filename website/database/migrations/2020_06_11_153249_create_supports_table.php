<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for supports.
 */
class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * References for lessons.
		 */
		Schema::create('supports', function (Blueprint $table) {
			/* Support's id */
            $table->id();
			/* Support's reference */
			$table->string('ref');
			/* Support's visibility (to choose if only members can see it) */
			$table->boolean('visibility')->default(false);
			/* Support's name */
			$table->string('name');
			/* The lesson linked to the support id */
			$table->BigInteger('cours_id')->unsigned();
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
        Schema::dropIfExists('supports');
    }
}
