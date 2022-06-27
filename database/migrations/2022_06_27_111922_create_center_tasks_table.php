<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('task_id');
            $table
                ->foreign('center_id')
                ->references('id')
                ->on('centers');
            $table
                ->foreign('task_id')
                ->references('id')
                ->on('tasks');
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
        Schema::dropIfExists('center_tasks');
    }
}