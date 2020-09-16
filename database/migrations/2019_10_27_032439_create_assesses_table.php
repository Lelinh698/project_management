<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doc_overtime')->nullable();
            $table->integer('diary_overtime')->nullable();
            $table->integer('process_mark')->unsigned()->nullable();
            $table->integer('end_mark')->unsigned()->nullable();
            $table->integer('id_project')->unsigned();

            $table->foreign('id_project')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assesses');
    }
}
