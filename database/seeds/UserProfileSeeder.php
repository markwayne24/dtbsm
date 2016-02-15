<?php

use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_groups')->truncate();

        $userProfiles = [
            [
                'user_id'  => 1,
                'firstname' => 'admin',
                'middlename' => 'admin',
                'lastname' => 'admin',
                'address' => 'Tarlac',
                'gender' => 'male',
                'mobilenum' => '09124092030',
            ],
            [
                'user_id'  => 2,
                'firstname' => 'User',
                'middlename' => 'User',
                'lastname' => 'User',
                'address' => 'Capas',
                'gender' => 'female',
                'mobilenum' => '09194092030',
            ]
        ];

        foreach ($userProfiles as $userProfiles) {
            \App\Models\UserProfile::create($userProfiles);
        }
    }
}
