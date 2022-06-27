<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->unsignedBigInteger('department_id');
            $table->string('task_title');
            $table->boolean('completed')->default(0);
            $table->timestamps();
            $table->dateTime('duedate')->nullable();
        });

        /*
        Delete tasks associated with this Department ID
        */
        Schema::table('tasks', function (Blueprint $table) {
            $table
                ->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        /*
        Delete tasks associated with this user ID
        */
        // Schema::table('tasks', function (Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade') ;
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}