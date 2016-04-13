<?php

use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budget')->truncate();

        $budgets = [
            [
                'amount' => 20000000,
            ]
        ];

        foreach ($budgets as $budget) {
            \App\Models\Budget::create($budget);
        }
    }
}
