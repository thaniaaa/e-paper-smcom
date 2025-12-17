<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;


class SubscriptionPlanSeeder extends Seeder
{
    public function run(): void
    {
        SubscriptionPlan::insert([
            [
                'name' => '1 Bulan',
                'duration_in_days' => 30,
                'price' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '6 Bulan',
                'duration_in_days' => 180,
                'price' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '1 Tahun',
                'duration_in_days' => 365,
                'price' => 250000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
