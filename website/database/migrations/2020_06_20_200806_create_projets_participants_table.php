<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('projets_participants', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('projet_id')->unsigned();
            $table->BigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('projet_id')
                ->references('id')
                ->on('projets');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projets_participants');
    }
}
