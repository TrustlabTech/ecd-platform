<?php

use Illuminate\Database\Seeder;

class ECDQualificationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ecd_qualifications')->insert([
            'id' => '1',
            'name' => 'No Level'
        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '50',
            'name' => 'Basic'
        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '100',
            'name' => 'Level 1 - In Progress'

        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '101',
            'name' => 'Level 1'
        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '200',
            'name' => 'Level 2 - In Progress'
        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '201',
            'name' => 'Level 2'
        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '300',
            'name' => 'Level 3 - In Progress'
        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '301',
            'name' => 'Level 3'

        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '400',
            'name' => 'Level 4 - In Progress'
        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '401',
            'name' => 'Level 4'
        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '500',
            'name' => 'Level 5 - In Progress'
        ]);

        DB::table('ecd_qualifications')->insert([
            'id' => '501',
            'name' => 'Level 5'

        ]);
    }
}
