<?php
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'staff',
        ]);

        DB::table('roles')->insert([
            'name' => 'external_user',
        ]);
        DB::table('roles')->insert([
            'name' => 'external_api',
        ]);
    }
}
