<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientTableSeeder extends Seeder
{

    public function run()
    {
        // DB::table('patients')->insert([
        //     'name' =>  'احمد محمد  علي',
        //     'age' => '22',
        //     'phone' => '123',
        //     'gender_id' => '1',
        //     'year' => '2023',
        //     'date' => '2023-09-27',
        //     'address' => 'مريض',
        //     'password' => Hash::make('123'),
        // ]);

        // DB::table('patients')->insert([
        //     'name' =>  'ساره احمد صالح قاسم',
        //     'age' => '18',
        //     'phone' => '123',
        //     'gender_id' => 2,
        //     'year' => '2023',
        //     'date' => '2023-09-27',
        //     'address' => 'مريض',
        //     'password' => Hash::make('123'),
        // ]);


        $Patients = new Patient();
        $Patients->name = 'ساره احمد صالح قاسم';
        $Patients->password = Hash::make('123');
        $Patients->age = 22;
        $Patients->phone = '123';
        $Patients->date = '1988-12-01';
        $Patients->gender_id = 1;
        $Patients->year = 2023;
        $Patients->address = 'مريض';
        $Patients->save();

    }
}
