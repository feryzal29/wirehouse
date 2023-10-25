<?php

namespace Database\Seeders;

use App\Models\plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        plan::create([
            'name' => 'BRE'
        ]);

        plan::create([
            'name' => 'EBL'
        ]);

        plan::create([
            'name' => 'AGM'
        ]);
        
        plan::create([
            'name' => 'FAD'
        ]);
    }
}
