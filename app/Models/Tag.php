<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function talkProposals()
    {
        return $this->belongsToMany(TalkProposal::class, 'talk_proposal_tag');
    }
}
