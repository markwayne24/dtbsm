<?php

use Illuminate\Database\Seeder;

class NotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notif')->truncate();

        $userNotif = [
            [
                'user_id'  => 2,
                'description'  => "Bag",
                'message'  => "Need to approve"
            ],
            [
                'user_id'  => 3,
                'description'  => "Jacket",
                'message'  => "Need to approve"
            ],
            [
                'user_id'  => 4,
                'description'  => "Table",
                'message'  => "Need to approve"
            ],
            [
                'user_id'  => 2,
                'description'  => "Tools",
                'message'  => "Need to approve"
            ],
            [
                'user_id'  => 4,
                'description'  => "Laptop",
                'message'  => "Need to approve"
            ],
            [
                'user_id'  => 4,
                'description'  => "Cup",
                'message'  => "Need to approve"
            ],
            [
                'user_id'  => 4,
                'description'  => "Speaker",
                'message'  => "Need to approve"
            ],
            [
                'user_id'  => 2,
                'description'  => "Chocolates",
                'message'  => "Need to approve"
            ]
        ];

        foreach ($userNotif as $notif) {
            \App\Models\Notif::create($notif);
        }
    }
}
