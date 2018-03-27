<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('centres', function (Blueprint $table) {
            $table->enum('facility_type', ['Creche', 'After School Centre', 'Educare/ECD'])->nullable();
            $table->string('contact_person')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('operation_hours')->nullable();
            $table->string('operation_days')->nullable();
            $table->string('npo_number')->nullable();
            $table->string('children_enrolled')->nullable();
            $table->string('min_age')->nullable();
            $table->string('max_age')->nullable();
            $table->date('last_facility_registration_date')->nullable();
            $table->date('registration_lapses_date')->nullable();
            $table->date('ecd_programme_registration_date')->nullable();
            $table->date('ecd_programme_laps_date')->nullable();
            $table->string('funding_status')->nullable();
            $table->enum('qualifies_funding', ['Yes', 'No'])->nullable();
            $table->string('number_of_staff')->nullable();
            $table->string('principal_qualification_level')->nullable();
            $table->string('staff_qualification_levels')->nullable();
            $table->enum('ecd_programme_registration_type', ['NCF - Grassroots site learning', 'NCF - ELRU', 'Masikhule', 'Early Years', 'TEEC', 'Learn 2 Live'])->nullable();
            $table->string('regional_office')->nullable();
            $table->string('service_delivery')->nullable();
            $table->string('area_municipality')->nullable();
            $table->string('main_place')->nullable();
            $table->dropColumn(['number_children_allowed']);
            $table->string('registered_children_total')->nullable();
            $table->dropColumn(['is_cf_unregistered']);
            $table->enum('registration_status', ['Unregistered', 'Registered', 'Conditional'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('centres', function (Blueprint $table) {
            $table->dropColumn(['facility_type']);
            $table->dropColumn(['contact_person']);
            $table->dropColumn(['fax_number']);
            $table->dropColumn(['email_address']);
            $table->dropColumn(['operation_hours']);
            $table->dropColumn(['operation_days']);
            $table->dropColumn(['npo_number']);
            $table->dropColumn(['children_enrolled']);
            $table->dropColumn(['min_age']);
            $table->dropColumn(['max_age']);
            $table->dropColumn(['last_facility_registration_date']);
            $table->dropColumn(['registration_lapses_date']);
            $table->dropColumn(['ecd_programme_registration_date']);
            $table->dropColumn(['ecd_programme_laps_date']);
            $table->dropColumn(['funding_status']);
            $table->dropColumn(['qualifies_funding']);
            $table->dropColumn(['number_of_staff']);
            $table->dropColumn(['principal_qualification_level']);
            $table->dropColumn(['staff_qualification_levels']);
            $table->dropColumn(['ecd_programme_registration_type']);
            $table->dropColumn(['regional_office']);
            $table->dropColumn(['service_delivery']);
            $table->dropColumn(['area_municipality']);
            $table->dropColumn(['main_place']);
            $table->dropColumn(['registered_children_total']);
            $table->string('number_children_allowed')->nullable();
            $table->dropColumn(['registration_status']);
            $table->boolean('is_cf_unregistered', false)->nullable();
        });
    }
}
