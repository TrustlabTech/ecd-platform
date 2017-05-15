<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('admin'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Centre::class, function (Faker\Generator $faker) {
    return [
        'did' => str_random(32),
        'name' => $faker->company,
        'nat_emis' => str_random(10),
        'c_code' => str_random(30),
        'mobile_number' => $faker->e164PhoneNumber,
        'landline_number' => $faker->e164PhoneNumber,
        'erf_number' => $faker->buildingNumber,
        //'number_children_allowed' => '100',
        //'is_cf_unregistered' => false,
        'is_cf_registered' => true,
        'is_cf_partial_registered' => false,
        'cf_certificate_expiry' => $faker->date,
        'address_locality' => $faker->cityPrefix,
        'address_region' => $faker->city,
        'street_address' => $faker->streetAddress,
        'address_country' => $faker->country,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'doe_status' => 'Open',
        'doe_type' => 'Early Childhood Development Centre',
        'sector' => 'Independant',
        'doe_phase' => 'Pre-Primary School',
        'specialisation' => 'Early Childhood Basic Education',
        'owner_land' => 'Private',
        'owner_build' => 'SOS Childrens Village'
    ];
});

$factory->defineAs(App\Models\Staff::class, 'user_staff', function (Faker\Generator $faker) {
    return [
        'did' => str_random(32),
        'za_id_number' => $faker->randomNumber(9),
        'family_name' => $faker->lastName,
        'given_name' => $faker->firstName,
        'principle' => false,
        'practitioner' => true,
        'volunteer' => false,
        'cook' => false,
        'other' => false,
        'registration_latitude' => $faker->latitude,
        'registration_longitude' => $faker->longitude,
        'ecd_qualification_id' => '1',
        'phone_number' => $faker->e164PhoneNumber,
        'password' => '123456',
        'centre_id' => factory(App\Models\Centre::class)->create()->id,
        'gender' => 'male',
        'citizenship' => 'ZA',
        'date_of_birth' => $faker->date()
    ];
});

$factory->define(App\Models\Staff::class, function (Faker\Generator $faker) {
    return [
        'did' => str_random(32),
        'za_id_number' => $faker->randomNumber(9),
        'family_name' => $faker->lastName,
        'given_name' => $faker->firstName,
        'principle' => false,
        'practitioner' => true,
        'volunteer' => false,
        'cook' => false,
        'other' => false,
        'registration_latitude' => $faker->latitude,
        'registration_longitude' => $faker->longitude,
        'ecd_qualification_id' => '1',
        'centre_id' => factory(App\Models\Centre::class)->create()->id,
        'user_id' => factory(App\Models\User::class)->create(['username' => $faker->e164PhoneNumber])->id,
        'gender' => 'male',
        'citizenship' => 'ZA',
        'date_of_birth' => $faker->date()
    ];
});

$factory->define(App\Models\CentreClass::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->streetName,
        'centre_id' => factory(App\Models\Centre::class)->create()->id,
    ];
});

$factory->define(App\Models\Child::class, function (Faker\Generator $faker) {
    return [
        'did' => str_random(32),
        'id_number' => $faker->randomNumber(9),
        'family_name' => $faker->lastName,
        'given_name' => $faker->firstName,
        'registration_latitude' => $faker->latitude,
        'registration_longitude' => $faker->longitude,
        'centre_class_id' => factory(App\Models\CentreClass::class)->create()->id
    ];
});

$factory->define(App\Models\ChildAttendance::class, function (Faker\Generator $faker) {
    return [
        'attended' => $faker->boolean($chanceOfGettingTrue = 50),
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'children_id' => factory(App\Models\Child::class)->create()->id
    ];
});

$factory->define(App\Models\Admin::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'user_id' => factory(App\Models\User::class)->create()->id
    ];
});

$factory->define(App\Models\BankDetail::class, function (Faker\Generator $faker) {
    return [
        'bank_name' => 'NEDBANK',
        'account_number' => $faker->randomNumber(9),
        'branch_code' => $faker->randomNumber(6),
        'centre_id' => '1'
    ];
});
