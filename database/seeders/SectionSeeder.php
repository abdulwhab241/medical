<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $Sections = [
        //     ['name' => 'قسم القلب'],
        //     ['name' => 'قسم الباطنية'],
        //     ['description' => 'قسم القلب'],
        //     ['description' => 'قسم الباطنية'],


        // ];
        // foreach ($Sections as $Section) {
        //     Section::create($Section);
        // }

        DB::table('sections')->insert([
            'name' => 'قسم القلب',
            'description' => 'قسم القلب',
        ]);

        DB::table('sections')->insert([
            'name' => 'قسم الباطنية',
            'description' => 'قسم الباطنية',
        ]);
    }
}
