<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name', 40)->unique();
            $table->string('description', 400);

            $table->unsignedInteger('gameId');
            $table->foreign('gameId')
            ->references('id')
            ->on('games')
            ->unsigned()
            ->constrained('games')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedInteger('creatorId');
            $table->foreign('creatorId')
            ->references('id')
            ->on('users')
            ->unsigned()
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('parties');
    }
}