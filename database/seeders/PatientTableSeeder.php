<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientTableSeeder extends Seeder
{

    public function run()
    {
        $Patients = new Patient();
        $Patients->name = 'مريض';
        $Patients->password = Hash::make('123');
        $Patients->birth_date = '1988-12-01';
        $Patients->phone = '123';
        $Patients->gender = 1;
        $Patients->year = 2023;
        $Patients->address = 'مريض';
        $Patients->save();

    }
}
