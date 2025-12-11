<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectEvaluation;
use App\Models\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        // Authorize that the user can view project evaluations
        $this->authorizeProjectAccess($project);

        $evaluations = $project->projectEvaluations()
            ->with(['evaluator', 'teamMember'])
            ->latest()
            ->get();

        return view('projects.evaluations.index', compact('project', 'evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        // Authorize that the user can create project evaluations
        $this->authorizeProjectManagement($project);

        $projectMembers = $project->projectMembers()
            ->with('user')
            ->get();

        return view('projects.evaluations.create', compact('project', 'projectMembers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        // Authorize that the user can create project evaluations
        $this->authorizeProjectManagement($project);

        $request->validate([
            'team_member_id' => 'required|exists:users,id',
            'produktivitas_tim' => 'required|integer|min:0|max:100',
            'efektivitas_sistem' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        $project->projectEvaluations()->create([
            'evaluator_id' => Auth::id(),
            'team_member_id' => $request->team_member_id,
            'nama_tim' => 'Tim Kerja',
            'efektivitas_sistem' => $request->efektivitas_sistem,
            'produktivitas_tim' => $request->produktivitas_tim,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('projects.evaluations.index', $project)
            ->with('success', 'Evaluasi berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, ProjectEvaluation $projectEvaluation)
    {
        // Authorize that the user can view this evaluation
        $this->authorizeProjectAccess($project);

        // Make sure the evaluation belongs to the project
        if ($projectEvaluation->project_id !== $project->id) {
            abort(404, 'Evaluation not found in this project');
        }

        $projectEvaluation->load(['evaluator', 'teamMember']);
        
        return view('projects.evaluations.show', [
            'project' => $project,
            'evaluation' => $projectEvaluation
        ]);
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit(Project $project, ProjectEvaluation $projectEvaluation)
    {
        // Authorize that the user can manage the project
        $this->authorizeProjectManagement($project);

        // Make sure the evaluation belongs to the project
        if ($projectEvaluation->project_id !== $project->id) {
            abort(404, 'Evaluation not found in this project');
        }

        $projectMembers = $project->projectMembers()
            ->with('user')
            ->get();

        $projectEvaluation->load(['teamMember']);

        return view('projects.evaluations.edit', [
            'project' => $project,
            'evaluation' => $projectEvaluation,
            'projectMembers' => $projectMembers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, ProjectEvaluation $projectEvaluation)
    {
        // Authorize that the user can manage the project
        $this->authorizeProjectManagement($project);

        // Make sure the evaluation belongs to the project
        if ($projectEvaluation->project_id !== $project->id) {
            abort(404, 'Evaluation not found in this project');
        }

        $request->validate([
            'team_member_id' => 'required|exists:users,id',
            'produktivitas_tim' => 'required|integer|min:0|max:100',
            'efektivitas_sistem' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        $projectEvaluation->update([
            'team_member_id' => $request->team_member_id,
            'produktivitas_tim' => $request->produktivitas_tim,
            'efektivitas_sistem' => $request->efektivitas_sistem,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('projects.evaluations.show', [$project, $projectEvaluation])
            ->with('success', 'Evaluasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, ProjectEvaluation $projectEvaluation)
    {
        // Authorize that the user can manage the project
        $this->authorizeProjectManagement($project);

        // Make sure the evaluation belongs to the project
        if ($projectEvaluation->project_id !== $project->id) {
            abort(404, 'Evaluation not found in this project');
        }

        $projectEvaluation->delete();

        return redirect()->route('projects.evaluations.index', $project)
            ->with('success', 'Evaluasi berhasil dihapus!');
    }

    /**
     * Authorize that the user can access the project (owner or member)
     */
    private function authorizeProjectAccess(Project $project)
    {
        $userId = Auth::id();

        // Allow if user is the owner
        if ($project->owner_id === $userId) {
            return true;
        }

        // Allow if user is a member of the project
        $isMember = $project->projectMembers()
            ->where('user_id', $userId)
            ->exists();

        if ($isMember) {
            return true;
        }

        // Deny access otherwise
        abort(403, 'Unauthorized to access this project');
    }

    /**
     * Authorize that the user can manage the project (owner or manager)
     */
    private function authorizeProjectManagement(Project $project)
    {
        $userId = Auth::id();

        // Allow if user is the owner
        if ($project->owner_id === $userId) {
            return true;
        }

        // Allow if user is a manager in the project
        $projectMember = $project->projectMembers()
            ->where('user_id', $userId)
            ->first();

        if ($projectMember && $projectMember->role === 'manager') {
            return true;
        }

        // Deny access otherwise
        abort(403, 'Unauthorized to manage this project');
    }
}
