<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for projects.
 */
class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
		/**
		 * Table for collaborators.
		 */
        Schema::create('collaborateurs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link');
            $table->string('image');
            $table->timestamps();
        });

		/**
		 * Table for projects.
		 */
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc');
            $table->json('images')->nullable();
            $table->string('link_github')->nullable();
            $table->string('link_download')->nullable();
            $table->string('link_doc')->nullable();
            $table->boolean('complete')->default(0);
            $table->BigInteger('chef_projet_id')->unsigned();
            $table->BigInteger('pole_id')->unsigned();
            $table->BigInteger('collaborateur_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('chef_projet_id')
                ->references('id')
                ->on('users');

            $table->foreign('pole_id')
                ->references('id')
                ->on('poles');

            $table->foreign('collaborateur_id')
                ->references('id')
                ->on('collaborateurs');
        });

        /**
		 * linking table between projets and users
		 */
        Schema::create('projets_participants', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('projet_id')->unsigned();
            $table->BigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->unique(['projet_id', 'user_id']);

            $table->foreign('projet_id')
                ->references('id')
                ->on('projets')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('collaborateurs');
        Schema::dropIfExists('projets');
        Schema::dropIfExists('projets_participants');
    }
}
