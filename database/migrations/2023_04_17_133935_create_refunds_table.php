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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teacher_booked')->unsigned();
            $table->bigInteger('booked_by')->unsigned();
            $table->bigInteger('meeting_id')->unsigned();
            $table->bigInteger('amount')->nuallbel();
            $table->timestamps();

            $table->foreign('teacher_booked')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('booked_by')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('meeting_id')
            ->references('id')
            ->on('zoom_meetings')
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
        Schema::dropIfExists('refunds');
    }
};
