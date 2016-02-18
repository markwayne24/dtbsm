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

        $users = [
            [
                'group_id' => 1,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'remember_token' => str_random(10)
            ],
            [
                'group_id' => 2,
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'remember_token' => str_random(10)
            ],
            [
                'group_id' => 2,
                'email' => $faker->email,
                'password' => Hash::make('user'),
                'remember_token' => str_random(10)
            ]
        ];


        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
