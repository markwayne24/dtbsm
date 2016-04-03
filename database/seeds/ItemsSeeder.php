<?php

use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->truncate();

        $item_types = [
            [
                'item_type_id' => 1,
                'name'  => 'OROCAN'
            ]
        ];

        foreach ($item_types as $item_type) {
            \App\Models\Items::create($item_type);
        }
    }
}
