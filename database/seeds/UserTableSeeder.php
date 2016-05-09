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
                    'contact_number' => '09167563096'
                ]
            ],
            [
                'group_id' => 2,
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'remember_token' => str_random(10),
                'profile'   => [
                    'firstname' => 'User',
                    'middlename' => 'U',
                    'lastname' => 'User',
                    'address' => 'Tarlac',
                    'gender' => 'male',
                    'contact_number' => '09124092030',
                    'school'=> 'Buhilit',
                    'district'=> 2
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
