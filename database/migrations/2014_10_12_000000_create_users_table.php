<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ADD CLAN NAME & CLAN TABLE AT BACKEND! CLAN TAG!

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 14)->unique();;
            $table->string('steamUsername', 50)->nullable();
            $table->string('companyArea', 30);
            $table->string('email', 100)->unique();
            $table->string('password', 20);
            $table->string('role', 10)->nullable();
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
        Schema::dropIfExists('users');
    }
}
