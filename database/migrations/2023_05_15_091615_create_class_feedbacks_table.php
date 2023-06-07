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
        Schema::create('class_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('zoom_id')->unsigned();
            $table->string('option')->nullable();
            $table->time('ended');
            $table->bigInteger('amount');
            $table->smallInteger('status')->default(0);
            $table->bigInteger('percentage');
            $table->timestamps();
            
            
            $table->foreign('zoom_id')
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
        Schema::dropIfExists('class_feedbacks');
    }
};
