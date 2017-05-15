<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        $id1 = DB::table('users')->insertGetId([
            'email' => $faker->safeEmail,
            'password' => bcrypt('admin')
        ]);

        $id2 = DB::table('users')->insertGetId([
            'email' => $faker->safeEmail,
            'password' => bcrypt('admin')

        ]);

        $id3 = DB::table('users')->insertGetId([
            'email' => $faker->safeEmail,
            'password' => bcrypt('admin')
        ]);

        $id4 = DB::table('users')->insertGetId([
            'email' => $faker->safeEmail,
            'password' => bcrypt('admin')
        ]);

        DB::table('admins')->insert([
            'first_name' => '',
            'last_name' => '',
            'user_id' => $id1
        ]);
        DB::table('admins')->insert([
            'first_name' => '',
            'last_name' => '',
            'user_id' => $id2
        ]);
        DB::table('admins')->insert([
            'first_name' => '',
            'last_name' => '',
            'user_id' => $id3
        ]);
        DB::table('admins')->insert([
            'first_name' => '',
            'last_name' => '',
            'user_id' => $id4
        ]);

        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => $id1
        ]);
        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => $id2
        ]);
        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => $id3
        ]);
        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => $id4
        ]);
    }
}
