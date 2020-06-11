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
        });

		/**
		 * link lessons and references
		 */
		Schema::create('refs_cours', function (Blueprint $table) {
            $table->id();
			$table->BigInteger('cours_id')->unsigned();
			$table->BigInteger('ref_id')->unsigned();

			$table->foreign('cours_id')
                ->references('id')
                ->on('cours');

			$table->foreign('ref_id')
                ->references('id')
                ->on('references');
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
        Schema::dropIfExists('refs_cours');
    }
}
