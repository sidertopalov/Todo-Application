<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_statuses', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
        });

        DB::table('task_statuses')->insert([
            ['name' => 'to_be_done'],
            ['name' => 'completed'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_statuses', function (Blueprint $table) {

        });
    }
}
