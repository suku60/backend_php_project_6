<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            
            $table->increments('id');

            $table->string('message', 400);
            $table->date('date', 50);
            // find an api or a dateTime.now that sets this automatically

            $table->unsignedInteger('writerMember');
            $table->foreign('writerMember')
            ->references('id')
            ->on('users')
            ->unsigned()
            ->constrained('users')
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
        Schema::dropIfExists('messages');
    }
}