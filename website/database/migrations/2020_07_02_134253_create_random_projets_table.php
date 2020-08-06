<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for randomized project tables.
 */
class CreateRandomProjetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Table for randomized project (displayed in home page)
		 */
        Schema::create('random_projets', function (Blueprint $table) {
			/* Randomized project's id */
            $table->id();
			/* Real project's id */
            $table->BigInteger('projet_id')->unsigned();
			/* Date of creation of the randomized project */
            $table->timestamps();
			/* Indicate that "projet_id" is a foreign key linked to
			project's id */
            $table->foreign('projet_id')
                ->references('id')
                ->on('projets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('random_projets');
    }
}
