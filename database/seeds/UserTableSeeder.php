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
                'firstname' => $faker->firstName,
                'middlename' => $faker->lastName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'password' => bcrypt(str_random(10)),
                'address' => $faker->address,
                'gender' => 'male',
                'mobilenum' => '09124592430',
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
                'mobilenum' => '09352392210',
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
                'mobilenum' => '09145222110',
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
                'mobilenum' => '09164022110',
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
                'mobilenum' => '09194022110',
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
                'mobilenum' => '09192022110',
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
                'mobilenum' => '09194122110',
                'remember_token' => str_random(10)
            ],
        ];


        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
