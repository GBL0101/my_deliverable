<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     
    
    public function run()
    {
        DB::table('timetables')->insert([
                'name' => '1限',
                'start_time' => '2024-07-12 06:00:00',
                'end_time' => '2024-07-12 08:00:00',
        ]);
        
        DB::table('timetables')->insert([
                'name' => '2限',
                'start_time' => '2024-07-12 08:00:00',
                'end_time' => '2024-07-12 10:00:00',
        ]);
        
        DB::table('timetables')->insert([
                'name' => '3限',
                'start_time' => '2024-07-12 10:00:00',
                'end_time' => '2024-07-12 12:00:00',
        ]);
        
        DB::table('timetables')->insert([
                'name' => '1限',
                'start_time' => '2024-07-13 06:00:00',
                'end_time' => '2024-07-13 08:00:00',
        ]);
        
        DB::table('timetables')->insert([
                'name' => '2限',
                'start_time' => '2024-07-13 08:00:00',
                'end_time' => '2024-07-13 10:00:00',
        ]);
        
        DB::table('timetables')->insert([
                'name' => '3限',
                'start_time' => '2024-07-13 10:00:00',
                'end_time' => '2024-07-13 12:00:00',
        ]);
        
        DB::table('timetables')->insert([
                'name' => '1限',
                'start_time' => '2024-07-11 06:00:00',
                'end_time' => '2024-07-11 08:00:00',
        ]);
        
        DB::table('timetables')->insert([
                'name' => '2限',
                'start_time' => '2024-07-11 08:00:00',
                'end_time' => '2024-07-11 10:00:00',
        ]);
        
        DB::table('timetables')->insert([
                'name' => '3限',
                'start_time' => '2024-07-11 10:00:00',
                'end_time' => '2024-07-11 12:00:00',
        ]);
    }
}
