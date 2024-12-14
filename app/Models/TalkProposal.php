<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TalkProposal extends Model
{
    use HasFactory;
    
    public function revisions()
    {
        return $this->hasMany(TalkProposalRevision::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'talk_proposal_tag');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
