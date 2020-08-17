<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelineEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_events', function (Blueprint $table) {
            $table->id();
			$table->text('desc');
			$table->date('date');
			$table->BigInteger('reference_id')->unsigned();
			$table->string('timeline_type');
			$table->unique(['reference_id', 'timeline_type', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timeline_events');
    }
}
