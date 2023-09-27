<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaboratorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laboratory_employees')->insert([
            'name' => 'مخبري',
            'status' => '1',
            'phone' => '123',
            'date' => '2023-09-27',
            'address' => 'مخبري',
            'password' => Hash::make('123'),
        ]);
    }
}
