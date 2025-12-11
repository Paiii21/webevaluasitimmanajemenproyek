<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'owner_id',
    ];

    // Relationship: Project belongs to an owner (User)
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relationship: Project has many members
    public function projectMembers(): HasMany
    {
        return $this->hasMany(ProjectMember::class);
    }

    // Relationship: Project has many evaluations
    public function projectEvaluations(): HasMany
    {
        return $this->hasMany(ProjectEvaluation::class);
    }
}
