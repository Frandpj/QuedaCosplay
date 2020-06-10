<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('name')->nullable()->default(NULL);
            $table->string('surname')->nullable()->default(NULL);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->longText('password');
            $table->string('image')->nullable()->default(NULL);
            $table->integer('province_id');
            $table->integer('town_id');
            $table->softDeletes();
            $table->rememberToken();
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
