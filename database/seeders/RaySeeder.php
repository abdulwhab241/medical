<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ray_services')->insert([ 
            'name' => 'كشافة صدر',
            'price' => 5000,
            'date' => '2023-09-27',
            'status' => 1,
            'year' => 2023,
        ]);

        DB::table('ray_services')->insert([
            'name' => 'ايكو',
            'price' => 12000,
            'date' => '2023-09-27',
            'status' => 1,
            'year' => 2023,
        ]);
    }
}
