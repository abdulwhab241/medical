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
        $Sections = [
            ['name' => 'قسم القلب'],
            ['name' => 'قسم الباطنية'],

        ];
        foreach ($Sections as $Section) {
            Section::create($Section);
        }
    }
}
