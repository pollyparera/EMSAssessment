<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\TalkProposal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'talk_proposal_id' => TalkProposal::factory(),
            'reviewer_id' => User::factory(), 
            'rating' => $this->faker->numberBetween(1, 5), 
            'comments' => $this->faker->text, 
        ];
    }
}
