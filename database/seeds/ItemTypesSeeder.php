<?php

use Illuminate\Database\Seeder;

class ItemTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_type')->truncate();

        $item_types = [
            [
                'name'  => 'TABLES'
            ],
            [
                'name'  => 'CHAIRS'
            ]
        ];

        foreach ($item_types as $item_type) {
            \App\Models\ItemType::create($item_type);
        }
    }
}
