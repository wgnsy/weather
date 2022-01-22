<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->dateTime('sunrise');
            $table->dateTime('sunset');
            $table->longText('weather');
            $table->text('icon');
            $table->integer('temp');
            $table->integer('temp_min');
            $table->integer('temp_max');
            $table->integer('temp_feel');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->integer('clouds');
            $table->text('name');
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
        Schema::dropIfExists('weather');
    }
}
