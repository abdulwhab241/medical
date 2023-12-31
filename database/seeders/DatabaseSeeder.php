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

        $this->call(MedicineSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PatientTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(RaySeeder::class);
        $this->call(LaboratorySeeder::class);


    }
}
