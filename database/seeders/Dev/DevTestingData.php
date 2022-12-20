<?php

namespace Database\Seeders\Dev;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevTestingData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_years')->insert([
            'id' => 1,
            'year' => 110,
            'semester' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'verified_at' => null,
        ]);

        DB::table('agencies')->insert([
            'id' => 1,
            'abbreviation' => 'aeust',
            'name' => '亞東科大',
            'formal_name' => '亞東科大',
            'created_at' => now(),
            'updated_at' => now(),
            'verified_at' => null,
        ]);

        DB::table('courses')->insert([
            'id' => 1,
            'name' => '系統分析與設計',
            'no' => '1MI1008A1',
            'academic_year_id' => 1,
            'isenabled' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'verified_at' => null,
        ]);

        DB::table('members')->insert([
            'id' => 1,
            'account' => 'PI077',
            'name' => 'Dr. Liao',
            'agency_id' => 1,
            'line_id' => 'Ud8a3b9c8619abbbfb7e57ba2c4f9ced2',
            'created_at' => now(),
            'updated_at' => now(),
            'verified_at' => null,
        ]);

        DB::table('course_member')->insert([
            'id' => 1,
            'course_id' => 1,
            'member_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'verified_at' => null,
        ]);

        DB::table('roll_calls')->insert([
            'id' => 1,
            'url' => 'PI077/1655882188/1',
            'iscalled' => false,
            'course_member_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'verified_at' => null,
        ]);
    }
}
