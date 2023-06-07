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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teacher')->unsigned()->nullable();
            $table->bigInteger('student')->unsigned()->nullable();
            $table->string('invoice');
            $table->bigInteger('amount');
            $table->string('type');
            $table->smallInteger('status')->default(0);
            $table->string('subject')->nullable();
            $table->date('billing_date');
            $table->timestamps();
             
            $table->foreign('teacher')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('student')
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
        Schema::dropIfExists('transactions');
    }
};
