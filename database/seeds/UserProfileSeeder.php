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
                'contact_number' => '09124092030',
            ],
            [
                'user_id'  => 2,
                'firstname' => 'User',
                'middlename' => 'User',
                'lastname' => 'User',
                'address' => 'Capas',
                'school' => 'Tarlac High School',
                'gender' => 'female',
                'contact_number' => '09194092030',
            ],
            [
                'user_id'  => 3,
                'firstname' => $faker->firstName,
                'middlename' => $faker->lastName,
                'lastname' => $faker->lastName,
                'address' => $faker->address,
                'school' => 'Capas High School',
                'gender' => 'male',
                'contact_number' => '09124592430'
            ]
        ];

        foreach ($userProfiles as $userProfile) {
            \App\Models\UserProfile::create($userProfile);
        }
    }
}
