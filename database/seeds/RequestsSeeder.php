<?php

use Illuminate\Database\Seeder;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requests')->truncate();

        $requests = [
            [
                'user_id'  => 2,
            ]
        ];

        foreach ($requests as $request) {
            \App\Models\Requests::create($request);
        }
    }
}
