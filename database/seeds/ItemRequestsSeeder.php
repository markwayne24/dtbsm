<?php

use Illuminate\Database\Seeder;

class ItemRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_requests')->truncate();

        $item_requests = [
            [
                'request_id'  => 1,
                'inventory_id'=> 1,
                'quantity' => 2,
                'price'=> 24
            ]
        ];

        foreach ($item_requests as $item_request) {
            \App\Models\ItemRequests::create($item_request);
        }
    }
}
