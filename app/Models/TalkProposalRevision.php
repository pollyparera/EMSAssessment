<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalkProposalRevision extends Model
{
    protected $fillable = ['talk_proposal_id', 'changes', 'user_id', 'changed_at'];

    public function talkProposal()
    {
        return $this->belongsTo(TalkProposal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
