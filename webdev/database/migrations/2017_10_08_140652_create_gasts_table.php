<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('gasts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->string('cookies');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamps();
            $table->softDeletes();
            
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('gasts');
    }
}