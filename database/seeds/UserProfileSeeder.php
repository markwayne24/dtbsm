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
        $faker = Faker\Factory::create();
        DB::table('user_profiles')->truncate();

        $userProfiles = [
            [
                'user_id'  => 1,
                'firstname' => 'Admin',
                'middlename' => 'A',
                'lastname' => 'Administrator',
                'address' => 'Tarlac',
                'gender' => 'male',
                'contact_number' => '09167563096',
            ],
        ];

        foreach ($userProfiles as $userProfile) {
            \App\Models\UserProfile::create($userProfile);
        }
    }
}
