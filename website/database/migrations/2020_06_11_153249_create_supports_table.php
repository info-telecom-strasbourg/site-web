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
            $table->id();
			$table->string('ref');
			$table->boolean('visibility')->default(false);
			$table->string('name');
			$table->BigInteger('cours_id')->unsigned();

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
