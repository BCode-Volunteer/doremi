<?php

namespace Database\Seeders;

use App\Models\ContributionHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContributionHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContributionHistory::factory(10)->create();
    }
}
