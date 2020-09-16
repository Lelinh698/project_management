<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->date('deadline');
            $table->string('description');
            $table->text('name');
            $table->text('request');
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
        Schema::dropIfExists('department_plans');
    }
}
