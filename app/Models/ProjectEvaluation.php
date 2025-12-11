<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectEvaluation extends Model
{
    protected $fillable = [
        'project_id',
        'evaluator_id',
        'team_member_id',
        'nama_tim',
        'efektivitas_sistem',
        'produktivitas_tim',
        'catatan',
    ];

    // Relationship: Project evaluation belongs to a project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Relationship: Project evaluation created by an evaluator (User)
    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    // Relationship: Project evaluation is for a team member (User)
    public function teamMember(): BelongsTo
    {
        return $this->belongsTo(User::class, 'team_member_id');
    }
}
