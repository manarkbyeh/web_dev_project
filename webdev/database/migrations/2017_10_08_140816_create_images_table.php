<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->default('default.jpg');
            $table->boolean('win')->default(0);
            $table->integer('guest_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('guest_id')
            ->references('id')
            ->on('gasts')
            ->onDelete('cascade');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}