<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRandomProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('random_projets');
    }
}
