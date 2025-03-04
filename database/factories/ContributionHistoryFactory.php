<?php

namespace Database\Factories;

use App\Enums\ContributionStatusEnum;
use App\Models\Contribution;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContributionHistory>
 */
class ContributionHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contribution = Contribution::where('status', ContributionStatusEnum::PAID->value)->inRandomOrder()->first();
        if (!$contribution) {
            $contribution = Contribution::factory()->create([
                'status' => ContributionStatusEnum::PAID->value,
            ]);
        }

        return [
            'contribution_id' => $contribution->id,
            'amount' => fake()->randomDigit(),
            'date' => Carbon::now(),
        ];
    }
}
