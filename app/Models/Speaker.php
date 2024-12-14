<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speaker extends Authenticatable
{
    use HasFactory;
    
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
