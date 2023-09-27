<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            'name' => 'احمد الحداد',
            'status' => '1',
            'section_id' => '1',
            'phone' => '123',
            'address' => 'احمد الحداد',
            'password' => Hash::make('123'),
        ]);
    }
}
