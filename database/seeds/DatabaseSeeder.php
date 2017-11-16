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
         $this->call(DepartmentsTableSeeder::class);
         $this->call(MealsTableSeeder::class);
         $this->call(CompaniesTableSeeder::class);
    }
}
