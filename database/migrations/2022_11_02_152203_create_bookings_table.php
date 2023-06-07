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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('category_id')->unsigned();
            $table->string('level')->nullable();
            $table->bigInteger('booked_by')->unsigned();
            $table->bigInteger('teacher_booked')->unsigned();
            $table->string('meetup')->default('online');
            $table->string('subject');
            $table->longText('expectations')->nullable();
            $table->string('booked_times')->nullable();
            $table->date('date')->nullable(); 
            $table->bigInteger('amount_paid')->nullable();
            $table->smallInteger('seen')->default(0);
            $table->smallInteger('accepted')->default(0);
            $table->smallInteger('completed')->default(0);
            $table->timestamps();


            $table->foreign('booked_by')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('teacher_booked')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            // $table->foreign('category_id')
            // ->references('id')
            // ->on('categories')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
