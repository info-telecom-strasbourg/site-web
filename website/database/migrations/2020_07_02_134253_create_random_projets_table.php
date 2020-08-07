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
            $table->id();
            $table->BigInteger('projet_id')->unsigned();
            $table->timestamps();

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
