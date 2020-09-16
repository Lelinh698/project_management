<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_project')->unsigned();
            $table->string('diary_work');
            $table->string('done_work');
            $table->string('remain_work');
            $table->date('time');

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
        Schema::dropIfExists('progress_results');
    }
}
