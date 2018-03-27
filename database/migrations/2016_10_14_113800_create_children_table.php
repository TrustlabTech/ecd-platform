<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');
            $table->string('did', 32);
            $table->string('id_number', 255)->nullable();
            $table->string('family_name', 255)->nullable();
            $table->string('given_name', 255)->nullable();
            $table->decimal('registration_latitude', 11, 8)->nullable();
            $table->decimal('registration_longitude', 11, 8)->nullable();
            $table->unsignedInteger('centre_class_id');
            $table->timestamps();
        });

        Schema::table('children', function (Blueprint $table) {
            $table->foreign('centre_class_id')->references('id')->on('centre_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('children');
    }
}
