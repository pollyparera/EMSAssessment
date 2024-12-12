<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User as the modifier in Speaker Revisions
    public function speakerRevisions()
    {
        return $this->hasMany(SpeakerRevision::class);
    }

    // User as a reviewer of Talk Proposals
    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    // User as the author of Talk Proposal Revisions
    public function talkProposalRevisions()
    {
        return $this->hasMany(TalkProposalRevision::class, 'user_id');
    }
}
