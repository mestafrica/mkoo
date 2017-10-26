<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Information Technology (IT)',
            'Human Resource (HR)',
            'Finance',
            'Services',
            'Marketing',
            'Purchasing',
            'Sales',
            'Inventory',
            'Quality Assurance',
            'Insurance',
            'Licenses',
            'Compliance',
            'Customer Service',
            'Market Development',
            'Business Development',
            'Product Development',
            'Supply Chain Mgt./Logistics',
            'Strategy',
            'Operations',
			'Research and development (R&D)',
			'Canteen',
        ];

        foreach ($departments as $name) {
            App\Department::firstOrCreate(['name' => $name]);
        }
    }
}
