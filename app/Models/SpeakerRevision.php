<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpeakerRevision extends Model
{
    protected $fillable = ['speaker_id', 'changes', 'user_id', 'changed_at'];
    
    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
