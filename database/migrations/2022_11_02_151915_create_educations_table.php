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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('university')->nullable();
            $table->string('degree')->nullable();
            $table->string('result')->nullable();
            $table->string('passing_year')->nullable();
            $table->longText('comments')->nullable();
            $table->string('upload_file')->nullable();
            $table->smallInteger('is_verified')->default(0);
            $table->smallInteger('visible')->default(0);
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
        Schema::dropIfExists('educations');
    }
};
