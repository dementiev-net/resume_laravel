<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login', 45)->nullable(false)->unique('login');
            $table->string('password', 100)->nullable(false);
            $table->string('remember_token', 100)->nullable(true);
            $table->string('google_auth_code', 16)->nullable(true);
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
        Schema::dropIfExists('users_test');
    }
}
