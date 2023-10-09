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
            'date' => '2023-09-27',
            'user_doctor_id' => 4,
            'year' => 2023,
        ]);

    }

    
}
