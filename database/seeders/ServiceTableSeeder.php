<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{

    public function run()
    {
        $SingleService = new Service();
        $SingleService->name = 'استشارات طبية';
        $SingleService->price = 3000;
        $SingleService->status = 1;
        $SingleService->year = 2023;
        $SingleService->save();
    }
}
