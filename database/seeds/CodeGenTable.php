<?php

use Illuminate\Database\Seeder;

class CodeGenTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('code_gen')->truncate();

        $userGroups = [
            [
                'group_id'  => '1',
                'code'  => 1234,
            ]
        ];

        foreach ($userGroups as $group) {
            \App\Models\UserGroup::create($group);
        }
    }
}
