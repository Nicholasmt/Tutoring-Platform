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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->smallInteger('is_verified')->default(0);
            $table->smallInteger('verify_ready')->default(0);
            $table->smallInteger('email_verify')->default(0);
            $table->smallInteger('current_step')->default(1);
            $table->smallInteger('back_step')->default(0);
            $table->string('Oauth_type')->nullable();
            $table->string('Oauth_id')->nullable();
            $table->bigInteger('view_count')->default(0);
            $table->timestamps();

            $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
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
        Schema::dropIfExists('users');
    }
};
