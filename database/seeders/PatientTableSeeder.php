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

        $Patients = new Patient();
        $Patients->name = 'مريض';
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
