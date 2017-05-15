<?php

use Illuminate\Database\Seeder;

class ChildrenTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\Child::class, 20)->create();
    }
}
