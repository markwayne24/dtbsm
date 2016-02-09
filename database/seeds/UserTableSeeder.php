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
                'firstname' => 'admin',
                'middlename' => 'admin',
                'lastname' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'address' => 'Tarlac',
                'gender' => 'male',
                'mobilenum' => '09124092030',
                'remember_token' => str_random(10)
            ],
            [
                'group_id' => 2,
                'firstname' => $faker->firstName,
                'middlename' => $faker->lastName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'password' => bcrypt(str_random(10)),
                'address' => $faker->address,
                'gender' => 'male',
                'mobilenum' => $faker->numberBetween(0,9),
                'remember_token' => str_random(10)
            ],
            [
                'group_id' => 2,
                'firstname' => $faker->firstName,
                'middlename' => $faker->lastName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'password' => bcrypt(str_random(10)),
                'address' => $faker->address,
                'gender' => 'male',
                'mobilenum' => $faker->numberBetween(0,9),
                'remember_token' => str_random(10)
            ],
            [
                'group_id' => 2,
                'firstname' => $faker->firstName,
                'middlename' => $faker->lastName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'password' => bcrypt(str_random(10)),
                'address' => $faker->address,
                'gender' => 'male',
                'mobilenum' => $faker->numberBetween(0,9),
                'remember_token' => str_random(10)
            ]
        ];


        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
