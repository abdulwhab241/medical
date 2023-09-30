<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'محاسب',
            'job' => 'محاسب',
            'phone' => '123',
            'date' => '2023-09-27',
            'address' => 'محاسب',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'job' => 'admin',
            'phone' => '123',
            'date' => '2023-09-27',
            'address' => 'admin',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'احمد الحداد',
            'job' => 'دكتور',
            'section_id' => '1',
            'status' => '1',
            'date' => '2023-09-27',
            'phone' => '123',
            'address' => 'احمد الحداد',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'مخبري',
            'job' => 'المختبر',
            'phone' => '123',
            'date' => '2023-09-27',
            'address' => 'مخبري',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'اشعة',
            'job' => 'الأشعة',
            'phone' => '123',
            'date' => '2023-09-27',
            'address' => 'اشعة',
            'password' => Hash::make('123'),
        ]);
    }
}
