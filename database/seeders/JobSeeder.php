<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Jobs = [
            ['name' => 'Admin'],
            ['name' => 'محاسب'],
            ['name' => 'أشعة'],
            ['name' => 'دكتور'],
            ['name' => 'مختبري'],
            ['name' => 'ممرض'],
            ['name' => 'صيدلي'],
            ['name' => 'عامل النظافة'],
        ];
        foreach ($Jobs as $Job) {
            Job::create($Job);
        }
    }
}
