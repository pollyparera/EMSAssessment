<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TalkProposal;
use App\Models\Speaker;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TalkProposal>
 */
class TalkProposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TalkProposal::class;
    public function definition(): array
    {
        return [
            'speaker_id' => Speaker::factory(),
            'tag_id' => Tag::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
