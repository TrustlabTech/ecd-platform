<?php

use Illuminate\Database\Seeder;

class BankDetailsTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\BankDetail::class, 5)->create();
    }
}
