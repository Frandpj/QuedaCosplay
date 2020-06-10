<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable()->default(NULL);
            $table->string('description')->nullable()->default(NULL);
            $table->datetime('datetime')->nullable()->default(NULL);
            $table->string('location')->nullable()->default(NULL);
            $table->string('whatsappurl')->nullable()->default(NULL);
            $table->integer('user_id')->nullable()->default(NULL);
            $table->integer('province_id')->nullable()->default(NULL);
            $table->softDeletes();
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
        Schema::dropIfExists('stays');
    }
}
