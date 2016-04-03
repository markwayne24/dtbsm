<?php

use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventory')->truncate();

        $inventories = [
            [
                'item_id' => 1,
                'sku' => '2015-item',
                'price'=> 3 ,
                'stocks' => 3
            ]
        ];

        foreach ($inventories as $inventory) {
            \App\Models\Inventory::create($inventory);
        }
    }
}
