<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\TalkProposal;
use App\Models\TalkProposalRevision;
use App\Models\Tag;
use App\Models\Review;

class TalkProposalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_talk_proposal_can_have_many_revisions()
    {
        $talkProposal = TalkProposal::factory()->create();
        TalkProposalRevision::factory()->count(3)->for($talkProposal)->create();

        $this->assertCount(3, $talkProposal->revisions);
    }

    /** @test */
    public function a_talk_proposal_can_belong_to_many_tags()
    {
        $talkProposal = TalkProposal::factory()->create();
        $tags = Tag::factory()->count(2)->create();
        $talkProposal->tags()->attach($tags);

        $this->assertCount(2, $talkProposal->tags);
    }

    /** @test */
    public function a_talk_proposal_can_have_many_reviews()
    {
        $talkProposal = TalkProposal::factory()->create();
        Review::factory()->count(5)->for($talkProposal)->create();

        $this->assertCount(5, $talkProposal->reviews);
    }
}
