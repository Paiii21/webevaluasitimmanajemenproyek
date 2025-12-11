<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ProjectInvitation extends Model
{
    protected $fillable = [
        'project_id',
        'email',
        'inviter_id',
        'role',
        'token',
        'accepted_at',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    // Relationship: Invitation belongs to a project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Relationship: Invitation sent by a user
    public function inviter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inviter_id');
    }

    // Generate a unique token for the invitation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invitation) {
            $invitation->token = Str::random(64);

            // Set expiration date (e.g., 7 days from now)
            $invitation->expires_at = now()->addDays(7);
        });
    }

    // Check if the invitation has expired
    public function isExpired(): bool
    {
        return now()->gte($this->expires_at);
    }

    // Check if the invitation has been accepted
    public function isAccepted(): bool
    {
        return !is_null($this->accepted_at);
    }

    // Check if the invitation is still valid
    public function isValid(): bool
    {
        return !$this->isExpired() && !$this->isAccepted();
    }
}
