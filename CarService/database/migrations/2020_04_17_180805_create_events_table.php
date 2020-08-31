<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->default(null)->nullable();
            $table->string('start')->default(null)->nullable();
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('calendar_id')->unsigned()->default(null)->nullable();
            $table->bigInteger('reported_car_id')->unsigned();
            $table->float('price', 6, 2)->default(0.00);
            $table->timestamps();


            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade');
            $table->foreign('reported_car_id')->references('id')->on('reported_cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
