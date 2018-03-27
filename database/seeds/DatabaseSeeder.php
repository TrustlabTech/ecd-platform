<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PractitionerTableSeeder::class);
        $this->call(PrincipalTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(AdminTableSeeder::class);
        // $this->call(ECDQualificationsTableSeeder::class);
        // $this->call(AttachmentTypesTableSeeder::class);
        //
        //
        // $this->call(CentresTableSeeder::class);
        // $this->call(StaffTableSeeder::class);
        // $this->call(CentreClassesTableSeeder::class);
        // $this->call(ChildrenTableSeeder::class);
        // $this->call(BankDetailsTableSeeder::class);
    }
}
