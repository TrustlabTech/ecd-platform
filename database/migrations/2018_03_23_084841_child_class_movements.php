<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChildClassMovements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_class_movements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('child_id');
            $table->unsignedInteger('centre_id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('prev_class_id');
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
        Schema::drop('child_class_movements');
    }
}
