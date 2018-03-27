<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('did', 255)->nullable();
            $table->string('za_id_number')->nullable();
            $table->string('family_name', 255)->nullable();
            $table->string('given_name', 255)->nullable();
            $table->boolean('principle', false)->nullable();
            $table->boolean('practitioner', false)->nullable();
            $table->boolean('volunteer', false)->nullable();
            $table->boolean('cook', false)->nullable();
            $table->boolean('other', false)->nullable();
            $table->decimal('registration_latitude', 11, 8)->nullable();
            $table->decimal('registration_longitude', 11, 8)->nullable();
            $table->unsignedInteger('ecd_qualification_id');
            $table->unsignedInteger('centre_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('ecd_qualification_id')->references('id')->on('ecd_qualifications');
            $table->foreign('centre_id')->references('id')->on('centres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('staff');
    }
}
