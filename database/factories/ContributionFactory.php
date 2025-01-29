<?php

namespace Database\Factories;

use App\Enums\ContributionStatusEnum;
use App\Enums\ContributionTypeEnum;
use App\Models\Contributor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contribution>
 */
class ContributionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contributor_id = Contributor::pluck('id')->random();
        $types = array_column(ContributionTypeEnum::cases(), 'value');
        $status = array_column(ContributionStatusEnum::cases(), 'value');

        return [
            'contributor_id' => $contributor_id,
            'type' => fake()->randomElement($types),
            'value' => fake()->randomDigit(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(3),
            'status' => fake()->randomElement($status),
        ];
    }
}
