<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\TalkProposal;
use App\Models\TalkProposalRevision;
use App\Models\Tag;
use App\Models\Review;
use App\Models\User;  // Added import for the User model

class TalkProposalFeatureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_talk_proposal_with_relations()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a TalkProposal and related data
        $talkProposal = TalkProposal::factory()->create();

        // Add Revisions
        TalkProposalRevision::factory()->count(2)->for($talkProposal)->create();

        // Add Tags
        $tags = Tag::factory()->count(3)->create();
        $talkProposal->tags()->attach($tags);

        // Add Reviews
        Review::factory()->count(4)->for($talkProposal)->create();

        // Assertions
        $this->assertDatabaseHas('talk_proposals', ['id' => $talkProposal->id]);
        $this->assertCount(2, $talkProposal->revisions);
        $this->assertCount(3, $talkProposal->tags);
        $this->assertCount(4, $talkProposal->reviews);
    }

    #[Test]
    public function it_fetches_talk_proposals_with_tags_and_reviews()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Debugging: Ensure the user is authenticated
        $this->assertAuthenticated();

        // Create a TalkProposal and related data
        $talkProposal = TalkProposal::factory()->create();
        $tags = Tag::factory()->count(2)->create();
        $reviews = Review::factory()->count(3)->for($talkProposal)->create();

        $talkProposal->tags()->attach($tags);

        // Send GET request to the API route
        $response = $this->getJson(route('talk_proposals.index'));

        // Assertions
        $response->assertOk()
                ->assertJsonFragment(['id' => $talkProposal->id])
                ->assertJsonCount(2, 'data.0.tags')
                ->assertJsonCount(3, 'data.0.reviews');
    }
}