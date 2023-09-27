<?php

namespace Database\Seeders;

use App\Models\RayEmployee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RayEmployeeTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('ray_employees')->insert([
            'name' => 'اشعة',
            'status' => '1',
            'phone' => '123',
            'address' => 'اشعة',
            'password' => Hash::make('123'),
        ]);
        
    }
}
