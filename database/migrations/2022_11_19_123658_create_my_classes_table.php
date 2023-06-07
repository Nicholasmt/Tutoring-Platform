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
        Schema::create('my_classes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->date('date'); 
            $table->smallInteger('completed')->default(0);
            $table->timestamps();


           $table->foreign('booking_id')
            ->references('id')
            ->on('bookings')
            ->onDelete('cascade')
            ->onUpdate('cascade');
           
            $table->foreign('teacher_id')
           ->references('id')
           ->on('users')
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
        Schema::dropIfExists('my_classes');
    }
};
