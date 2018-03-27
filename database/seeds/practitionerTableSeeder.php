<?php

use Illuminate\Database\Seeder;

class PractitionerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id1 = DB::table('users')->insertGetId([
            'email' => 'practitioner@amply.tech',
            'password' => bcrypt('practitioner')
        ]);

        DB::table('practitioners')->insert([
            'first_name' => '',
            'last_name' => '',
            'user_id' => $id1
        ]);

        DB::table('role_user')->insert([
            'role_id' => '5',
            'user_id' => $id1
        ]);
    }
}
