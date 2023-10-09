<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaboratorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laboratory_services')->insert([
            'name' => 'فحص الكرياتين',
            'price' => 1200,
            'date' => '2023-09-27',
            'status' => 1,
            'year' => 2023,
        ]);

        DB::table('laboratory_services')->insert([
            'name' => 'فحص دم عام',
            'price' => 2000,
            'date' => '2023-09-27',
            'status' => 1,
            'year' => 2023,
        ]);
    }
}
