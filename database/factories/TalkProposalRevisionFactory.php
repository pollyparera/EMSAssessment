<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TalkProposalRevision>
 */
class TalkProposalRevisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'talk_proposal_id' => \App\Models\TalkProposal::factory(), 
            'changes' => $this->faker->text,
            'user_id' => \Database\Factories\UserFactory::new(), 
            'changed_at' => $this->faker->dateTimeThisYear(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
