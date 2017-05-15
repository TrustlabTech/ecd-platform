<?php

use Illuminate\Database\Seeder;

class AttachmentTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('attachment_types')->insert([
            'id' => '100',
            'name' => 'Photo of Person for Registration'
        ]);

        DB::table('attachment_types')->insert([
            'id' => '200',
            'name' => 'Photo of Person Identity Document'
        ]);

        DB::table('attachment_types')->insert([
            'id' => '300',
            'name' => 'Photo of Person for Attendance '
        ]);

        DB::table('attachment_types')->insert([
            'id' => '1000',
            'name' => 'Photo of Proof of Address'
        ]);

        DB::table('attachment_types')->insert([
            'id' => '1100',
            'name' => 'Photo of Health Clearance Certificate'
        ]);

        DB::table('attachment_types')->insert([
            'id' => '1200',
            'name' => 'Photo of Certificate of Registration of Care Facility'
        ]);
    }
}
