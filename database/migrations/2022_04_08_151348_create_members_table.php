<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {

            $table->increments('id');
            $table->string('partyUserTag', 7);

            $table->unsignedInteger('partyName');
            $table->foreign('partyName')
            ->references('name')
            ->on('parties')
            ->unsigned()
            ->constrained('parties')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            
            $table->unsignedInteger('partyId');
            $table->foreign('partyId')
            ->references('id')
            ->on('parties')
            ->unsigned()
            ->constrained('parties')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->unsignedInteger('userId');
            $table->foreign('userId')
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
        Schema::dropIfExists('members');
    }
}