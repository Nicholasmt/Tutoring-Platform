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
        Schema::create('tutor_requests', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->string('level')->nullable();
            $table->string('goal')->nullable();
            $table->string('often')->nullable();
            $table->string('price')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('gender')->nullable();
            $table->longtext('note')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutor_requests');
    }
};
