<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_teacher')->unsigned();
            $table->integer('id_department')->unsigned();
            $table->integer('id_project_type')->unsigned();
            $table->string('name')->nullable();
            $table->string('description')->nullable();

            $table->foreign('id_teacher')->references('id')->on('teachers');
            $table->foreign('id_department')->references('id')->on('departments');
            $table->foreign('id_project_type')->references('id')->on('project_types');
            // $table->foreign('id_assess')->references('id')->on('assesses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
