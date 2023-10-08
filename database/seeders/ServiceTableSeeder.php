<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTableSeeder extends Seeder
{

    public function run()
    {
        // $SingleService = new Service();
        // $SingleService->name = 'استشارات طبية';
        // $SingleService->price = 3000;
        // $SingleService->status = 1;
        // $SingleService->year = 2023;
        // $SingleService->save();

        DB::table('Services')->insert([
            'name' => 'استشارات طبية',
            'price' => 3000,
            'status' => 1,
            'year' => 2023,
        ]);

        DB::table('Services')->insert([
            'name' => 'كشافة صدر',
            'price' => 5000,
            'status' => 1,
            'year' => 2023,
        ]);

        DB::table('Services')->insert([
            'name' => 'ايكو',
            'price' => 12000,
            'status' => 1,
            'year' => 2023,
        ]);

        DB::table('Services')->insert([
            'name' => 'فحص الكرياتين',
            'price' => 1200,
            'status' => 1,
            'year' => 2023,
        ]);

        DB::table('Services')->insert([
            'name' => 'فحص دم عام',
            'price' => 2000,
            'status' => 1,
            'year' => 2023,
        ]);
    }

    
 
}
