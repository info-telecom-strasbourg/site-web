<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		/**
		 * Tags for the lesson
		 */
		Schema::create('tags', function (Blueprint $table) {
            $table->id();
			$table->string('tag');
        });
		/**
		 * link lessons and tags
		 */
		Schema::create('tags_cours', function (Blueprint $table) {
            $table->id();
			$table->BigInteger('cours_id')->unsigned();
			$table->BigInteger('tag_id')->unsigned();

			$table->foreign('cours_id')
                ->references('id')
                ->on('cours');

			$table->foreign('tag_id')
                ->references('id')
                ->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tags_cours');
    }
}
