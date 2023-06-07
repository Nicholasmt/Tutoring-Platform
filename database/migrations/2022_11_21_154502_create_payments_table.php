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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teacher')->unsigned();
            $table->bigInteger('student')->unsigned();
            $table->string('invoice');
            $table->bigInteger('amount');
            $table->string('transaction_type');
            $table->smallInteger('status')->default(0);
            $table->string('subject');
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
        Schema::dropIfExists('payments');
    }
};
