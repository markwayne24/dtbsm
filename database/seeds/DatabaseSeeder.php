<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

            $this->call(UserGroupsTableSeeder::class);
            $this->call(UserTableSeeder::class);
            $this->call(ItemTypesSeeder::class);
            $this->call(ItemsSeeder::class);
            $this->call(InventorySeeder::class);
            $this->call(RequestsSeeder::class);
            $this->call(ItemRequestsSeeder::class);
            //$this->call(UserProfileSeeder::class);

        Model::reguard();
    }
}
