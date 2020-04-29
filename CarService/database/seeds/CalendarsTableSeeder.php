<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendars')->insert([
            'user_id'=>1
        ]);
    }
}
