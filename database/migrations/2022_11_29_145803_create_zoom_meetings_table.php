<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id')->unsigned();
            $table->bigInteger('meeting_id');
            $table->string('password');
            $table->longText('start_url');
            $table->longText('join_url');
            $table->string('duration');
            $table->time('start_time');
            $table->time('class_started')->nullable();
            $table->time('class_ended')->nullable();
            $table->smallInteger('attended')->default(0);
            $table->smallInteger('pay')->default(0);
            $table->smallInteger('supervised')->default(0);
            $table->timestamps();


            $table->foreign('booking_id')
            ->references('id')
            ->on('bookings')
            ->onDelete('cascade')
            ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom_meetings');
    }
};
