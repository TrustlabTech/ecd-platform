<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimChildHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tim_child_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('child_id')->nullable();
            $table->string('id_number', 255);
            $table->text('raw_response');
            $table->enum('action', ['vertification', 'retrieval']);
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
        Schema::drop('tim_child_history');
    }
}
