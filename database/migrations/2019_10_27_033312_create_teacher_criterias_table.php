<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_criterias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('weight');
            $table->float('mark');
            $table->boolean('type');
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
        Schema::dropIfExists('teacher_criterias');
    }
}
