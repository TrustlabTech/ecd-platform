<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_details', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('bank_name', ['FNB', 'SBSA', 'CAPITEC', 'NEDBANK', 'ABSA'])->nullable();
            $table->string('account_number');
            $table->string('branch_code');
            $table->unsignedInteger('centre_id');
            $table->timestamps();
        });

        Schema::table('bank_details', function (Blueprint $table) {
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
        Schema::drop('bank_details');
    }
}
