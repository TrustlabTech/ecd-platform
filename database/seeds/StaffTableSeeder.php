<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        $id1 = DB::table('users')->insertGetId([
            'username' => $faker->e164PhoneNumber,
            'password' => bcrypt('123456'),
        ]);

        $id2 = DB::table('users')->insertGetId([
            'username' => $faker->e164PhoneNumber,
            'password' => bcrypt('123456'),
        ]);

        $id3 = DB::table('users')->insertGetId([
            'username' => $faker->e164PhoneNumber,
            'password' => bcrypt('123456'),
        ]);

        $id4 = DB::table('users')->insertGetId([
            'username' => $faker->e164PhoneNumber,
            'password' => bcrypt('123456'),
        ]);

        DB::table('staff')->insert([
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
            'centre_id' => '1',
            'user_id' => $id1
        ]);

        DB::table('staff')->insert([
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
            'centre_id' => '1',
            'user_id' => $id2
        ]);

        DB::table('staff')->insert([
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
            'centre_id' => '1',
            'user_id' => $id3
        ]);

        DB::table('staff')->insert([
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
            'centre_id' => '1',
            'user_id' => $id4
        ]);

        DB::table('role_user')->insert([
            'role_id' => '2',
            'user_id' => $id1
        ]);
        DB::table('role_user')->insert([
            'role_id' => '2',
            'user_id' => $id2
        ]);
        DB::table('role_user')->insert([
            'role_id' => '2',
            'user_id' => $id3
        ]);
        DB::table('role_user')->insert([
            'role_id' => '2',
            'user_id' => $id4
        ]);
    }
}
