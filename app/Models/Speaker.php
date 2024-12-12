<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = [
        'name',
        'bio',
        'photo',
    ];

    // Relationship to SpeakerRevision
    public function revisions()
    {
        return $this->hasMany(SpeakerRevision::class);
    }
}
