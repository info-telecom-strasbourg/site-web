<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		/**
		 * references for lessons
		 */
		Schema::create('references', function (Blueprint $table) {
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('references');
    }
}
