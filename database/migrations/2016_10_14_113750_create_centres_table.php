<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('did', 32);
            $table->string('name');
            $table->string('nat_emis', 255)->nullable();
            $table->string('c_code', 255)->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->string('landline_number', 20)->nullable();
            $table->string('erf_number')->nullable();
            $table->string('number_children_allowed')->nullable();
            $table->boolean('is_cf_unregistered', false)->nullable();
            $table->boolean('is_cf_registered', false)->nullable();
            $table->boolean('is_cf_partial_registered', false)->nullable();
            $table->date('cf_certificate_expiry')->nullable();
            $table->string('address_locality', 500)->nullable();
            $table->string('address_region')->nullable();
            $table->string('street_address')->nullable();
            $table->string('address_country')->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('post_address_locality', 500)->nullable();
            $table->string('post_address_region')->nullable();
            $table->string('post_street_address')->nullable();
            $table->string('post_office_box_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('post_address_country')->nullable();
            $table->enum('doe_status', ['Open', 'Pending Closed', 'Closed', 'Unknown'])->nullable();
            $table->enum('doe_type', ['Early Childhood Development Centre'])->nullable();
            $table->enum('sector', ['Independant', 'Public'])->nullable();
            $table->enum('doe_phase', ['Pre-Primary School'])->nullable();
            $table->enum('specialisation', ['Early Childhood Basic Education']);
            $table->enum('owner_land', ['Private', 'Public'])->nullable();
            $table->enum('owner_build', ['Private', 'Public', 'Independent', 'SOS Childrens Village', 'State', 'Unknown'])->nullable();
            $table->string('paypoint_no')->nullable();
            $table->string('component_no')->nullable();
            $table->string('magisterial_district')->nullable();
            $table->string('district_municipality')->nullable();
            $table->string('local_municipality')->nullable();
            $table->string('ward_id')->nullable();
            $table->string('el_region')->nullable();
            $table->string('el_district')->nullable();
            $table->string('el_circuit')->nullable();

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
        Schema::drop('centers');
    }
}
