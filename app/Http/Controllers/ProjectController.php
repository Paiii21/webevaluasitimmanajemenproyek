<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get projects where user is owner or member
        $projects = Project::where('owner_id', Auth::id())
            ->orWhereHas('projectMembers', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->withCount(['projectMembers', 'projectEvaluations'])
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => Auth::id(), // Current user becomes the owner
        ]);

        // Add the owner as a project member with 'owner' role
        $project->projectMembers()->create([
            'user_id' => Auth::id(),
            'role' => 'owner',
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyek berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Authorize that the user can view this project
        $this->authorizeProjectAccess($project);

        $project->load(['owner', 'projectMembers.user', 'projectEvaluations']);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Only project owner can edit the project
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized to edit this project');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Only project owner can update the project
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized to update this project');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyek berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Only project owner can delete the project
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized to delete this project');
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyek berhasil dihapus!');
    }

    /**
     * Authorize project access based on user's role in the project
     */
    private function authorizeProjectAccess(Project $project)
    {
        $userId = Auth::id();

        // Allow access if user is the owner
        if ($project->owner_id === $userId) {
            return true;
        }

        // Allow access if user is a member of the project
        $isMember = $project->projectMembers()
            ->where('user_id', $userId)
            ->exists();

        if ($isMember) {
            return true;
        }

        // Deny access otherwise
        abort(403, 'Unauthorized to access this project');
    }
}
