<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 30);
            $table->unsignedInteger('user_id');    
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('tasks', function (Blueprint $table) {

            $table->increments('id');
            $table->string('description', 60);
            $table->unsignedInteger('card_id');         
            $table->timestamps();

            $table->foreign('card_id')->references('id')->on('cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('cards');
    }
}
