<?php

use Illuminate\Database\Seeder;
use App\Models\UserGroup;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_groups')->truncate();

        $userGroups = [
            [
                'name'  => 'admin'
            ],
            [
                'name'  => 'user'
            ]
        ];

        foreach ($userGroups as $group) {
            \App\Models\UserGroup::create($group);
        }
    }
}
