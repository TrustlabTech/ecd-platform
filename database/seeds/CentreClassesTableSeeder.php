<?php

use Illuminate\Database\Seeder;

class CentreClassesTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\CentreClass::class, 2)->create();
    }
}
