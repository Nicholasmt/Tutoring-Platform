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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->smallInteger('messages')->default(0);
            $table->smallInteger('offers')->default(0);
            $table->smallInteger('activities')->default(0);
            $table->smallInteger('everything')->default(0);
            $table->smallInteger('no_push')->default(0);
            $table->smallInteger('send_as_email')->default(0);
            $table->timestamps();


            $table->foreign('user_id')
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
        Schema::dropIfExists('notifications');
    }
};
