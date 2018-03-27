<?php

use Illuminate\Database\Seeder;

class PrincipalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id1 = DB::table('users')->insertGetId([
            'email' => 'principal@amply.tech',
            'password' => bcrypt('principal')
        ]);

        DB::table('principals')->insert([
            'first_name' => '',
            'last_name' => '',
            'user_id' => $id1
        ]);

        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => $id1
        ]);
    }
}
