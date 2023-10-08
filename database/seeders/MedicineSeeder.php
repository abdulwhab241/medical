<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

            foreach(range(1,50) as $i){
        
            Medicine::create(
                [
                    "name"=>fake()->name,
                    "bar_code"=> fake()->numberBetween(10000, 200000),
                    "supplier"=>fake()->name,
                    "unit"=>'باكت',
                    "quantity"=> fake()->numberBetween(1, 20),
                    "buy_price"=> fake()->numberBetween(10000, 200000),
                    "sale_price"=>fake()->numberBetween(10000, 200000),
                    "end_date"=>fake()->date,
                    "total"=>fake()->numberBetween(10000, 200000),
                    "date"=>fake()->date,
                    'year' => fake()->year
                
                ]
                );

        }

    }
}
