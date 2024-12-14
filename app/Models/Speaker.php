<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Speaker extends Authenticatable
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
