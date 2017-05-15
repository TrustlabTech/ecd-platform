<?php

use Illuminate\Database\Seeder;

class CentresTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\Centre::class, 5)->create();
    }
}
