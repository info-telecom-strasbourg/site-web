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
			/* collaborator's id */
            $table->id();
			/* collaborator's name */
            $table->string('name');
			/* link to collaborator's website */
            $table->string('link');
			/* collaborator's image */
            $table->string('image');
			/* Date of creation of the collaborator */
            $table->timestamps();
        });

		/**
		 * Table for projects.
		 */
        Schema::create('projets', function (Blueprint $table) {
			/* Project's id */
            $table->id();
			/* Project's title */
            $table->string('title');
			/* Project's description */
            $table->text('desc');
			/* Project's images */
            $table->json('images')->nullable();
			/* Link to project's github */
            $table->string('link_github')->nullable();
			/* link to download the project */
            $table->string('link_download')->nullable();
			/* Link to the project's documentation */
            $table->string('link_doc')->nullable();
			/* Indicate if the project is considered as completed */
            $table->boolean('complete')->default(0);
			/* Project's leader's id */
            $table->BigInteger('chef_projet_id')->unsigned();
			/* The id of the pole that the project belongs */
            $table->BigInteger('pole_id')->unsigned();
			/* Project's collaborators */
            $table->BigInteger('collaborateur_id')->unsigned()->nullable();
			/* Date of project creation */
            $table->timestamps();
			/* Indicate that "chef_projet_id" is a foreign key that is linked
			to user's id */
            $table->foreign('chef_projet_id')
                ->references('id')
                ->on('users');
			/* Indicate that "pole_id" is a foreign key that is linked
			to pole's id */
            $table->foreign('pole_id')
                ->references('id')
                ->on('poles');
			/* Indicate that "collaborateur_id" is a foreign key that is linked
			to collaborator's id */
            $table->foreign('collaborateur_id')
                ->references('id')
                ->on('collaborateurs');
        });

        /**
		 * linking table between projets and users
		 */
        Schema::create('projets_participants', function (Blueprint $table) {
			/* id of the link */
            $table->id();
			/* The project that will be linked to the user */
            $table->BigInteger('projet_id')->unsigned();
			/* The user that will be linked to the project */
            $table->BigInteger('user_id')->unsigned();
			/* The date when the link was created */
            $table->timestamps();
			/* The project that will be linked to the user */
            $table->unique(['projet_id', 'user_id']); //???? Does that work ????
			/* Indicate that "projet_id" is a foreign key linked to
			project's id */
            $table->foreign('projet_id')
                ->references('id')
                ->on('projets')
                ->onDelete('cascade');
			/* Indicate that "user_id" is a foreign key linked to user's id */
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
