<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsOfPracticePracticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields_of_practice_practice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fields_of_practice_id')->unsigned();
            $table->foreign('fields_of_practice_id')->references('id')->on('fields_of_practice');
            $table->bigInteger('practice_id')->unsigned();
            $table->foreign('practice_id')->references('id')->on('practices');
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
        Schema::dropIfExists('fields_of_practice_practice');
    }
}
