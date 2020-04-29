<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [
                'name' => 'Przyjęte do realizacji',
                'color' => '#318af2'
            ],
            [
                'name' => 'W trakcie realizacji',
                'color' => '#9b31f2'
            ],
            [
                'name' => 'Wstrzymane',
                'color' => '#f23131'
            ],
            [
                'name' => 'Gotowe do odbioru',
                'color' => '#f2f131'
            ],
            [
                'name' => 'Zakończone',
                'color' => '#31f24e'
            ]
        ]);
    }
}
