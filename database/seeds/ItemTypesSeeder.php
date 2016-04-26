<?php

use Illuminate\Database\Seeder;

class ItemTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_type')->truncate();

        $item_types = [
            [
                'categories'=>'Facilities',
                'name'  => 'LABORATORY'
            ],
            [
                'categories'=>'Facilities',
                'name'  => 'CLINICS'
            ],
            [
                'categories'=>'Equipments',
                'name'  => 'COMPUTER'
            ],
            [
                'categories'=>'Equipments',
                'name'  => 'WINDOWS'
            ],
            [
                'categories'=>'Equipments',
                'name'  => 'DOOR'
            ],
            [
                'categories'=>'School Supplies',
                'name'  => 'PENCILS'
            ],
            [
                'categories'=>'School Supplies',
                'name'  => 'BALLPENS'
            ],
            [
                'categories'=>'School Supplies',
                'name'  => 'PAPERS'
            ],
            [
                'categories'=>'School Supplies',
                'name'  => 'NOTEBOOKS'
            ],
            [
                'categories'=>'School Supplies',
                'name'  => 'BOOKS'
            ],
        ];

        foreach ($item_types as $item_type) {
            \App\Models\ItemType::create($item_type);
        }
    }
}
