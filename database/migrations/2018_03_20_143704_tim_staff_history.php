<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimStaffHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tim_staff_history', function (Blueprint $table) {
            $table->unsignedInteger('staff_id')->nullable();
            $table->string('id_number');
            $table->text('raw_response');
            $table->enum('action',['vertification','retrieval']);
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
        Schema::drop('tim_staff_history');
    }
}
