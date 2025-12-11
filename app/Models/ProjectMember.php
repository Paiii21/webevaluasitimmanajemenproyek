<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMember extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'role',
    ];

    // Relationship: Project member belongs to a project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Relationship: Project member belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Project member can have evaluations (as team member)
    public function evaluationsReceived(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectEvaluation::class, 'team_member_id');
    }
}
