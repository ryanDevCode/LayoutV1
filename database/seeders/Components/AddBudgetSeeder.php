<?php

namespace Database\Seeders\Components;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AddBudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('add_budgets_request')->insert([

            'request_name' => 'Conference',
            'request_amount' => 20000,
            'request_description' => 'Attend marketing conference in San Angelo',
            'request_category' => 'C7',
            'request_type' => 'T2',
            'request_department' => 1004,
            'request_budget_code' => 1,
            'request_actualSpending' => 30000,
            'request_variance' => 20000,
            'request_varianceReason' => 'Conference',
            'request_status' => 'S1',
            'request_approvedBy' => 'johnrey.miranda',
            'request_approvedDate' => '2023-10-03',
            'request_approvedAmount' => 20000,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        DB::table('add_budgets_request')->insert([

            'request_name' => 'Old Sales Software',
            'request_amount' => 5000,
            'request_description' => 'Purchase new sales software for the sales team',
            'request_category' => 'C4',
            'request_type' => 'T2',
            'request_department' => 1002,
            'request_budget_code' => 2,
            'request_actualSpending' => 6000,
            'request_variance' => 11000,
            'request_varianceReason' => 'Additional costs for training and implementation',
            'request_status' => 'S1',
            'request_approvedBy' => 'jasonryan.odvina',
            'request_approvedDate' => '2023-10-03',
            'request_approvedAmount' => 5000,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        DB::table('add_budgets_request')->insert([

            'request_name' => 'New Server',
            'request_amount' => 5000,
            'request_description' => 'Purchase new servers to support the growing company',
            'request_category' => 'C3',
            'request_type' => 'T2',
            'request_department' => 1003,
            'request_budget_code' => 3,
            'request_actualSpending' => 6000,
            'request_variance' => 1100,
            'request_varianceReason' => 'Unexpected increase in server costs',
            'request_status' => 'S1',
            'request_approvedBy' => 'jasonryan.odvina',
            'request_approvedDate' => '2023-10-03',
            'request_approvedAmount' => 5000,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}
