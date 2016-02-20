<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('users')->truncate();
        DB::table('user_profiles')->truncate();

        $users = [
            [
                'group_id' => 1,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'remember_token' => str_random(10),
                'profile'   => [
                    'firstname' => 'Admin',
                    'middlename' => 'A',
                    'lastname' => 'Administrator',
                    'address' => 'Tarlac',
                    'gender' => 'male',
                    'contact_number' => '09124092030'
                ]
            ],
            [
                'group_id' => 2,
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'remember_token' => str_random(10),
                'profile'   => [
                    'firstname' => 'User',
                    'middlename' => 'User',
                    'lastname' => 'User',
                    'address' => 'Capas',
                    'gender' => 'female',
                    'contact_number' => '09194092030'
                ]
            ],
            [
                'group_id' => 2,
                'email' => $faker->email,
                'password' => Hash::make('user'),
                'remember_token' => str_random(10),
                'profile'   => [
                    'firstname' => $faker->firstName,
                    'middlename' => $faker->lastName,
                    'lastname' => $faker->lastName,
                    'address' => $faker->address,
                    'gender' => 'male',
                    'contact_number' => '09124592430'
                ]
            ]
        ];

        foreach ($users as $user) {
            $profile = $user['profile'];
            unset($user['profile']);

            $user = \App\Models\User::create($user);
            $user->userProfile()->create($profile);
        }
    }
}
