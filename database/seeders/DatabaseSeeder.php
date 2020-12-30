<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        \App\Models\Customer::factory(10)->create();
        \App\Models\Attendance::factory(10)->create();
        \App\Models\Payslip::factory(20)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Table::factory(7)->create();
        \App\Models\Item::factory(30)->create();
    }
}
