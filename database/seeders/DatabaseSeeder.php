<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(PatientTableSeeder::class);
        $this->call(RayEmployeeTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(LaboratorySeeder::class);


    }
}
