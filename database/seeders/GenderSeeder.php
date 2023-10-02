<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Genders = [
            ['name' => 'ذكر'],
            ['name' => 'انثى'],
        ];
        foreach ($Genders as $Gender) {
            Gender::create($Gender);
        }
    }
}
