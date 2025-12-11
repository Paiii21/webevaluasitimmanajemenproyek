<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProjectMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        // Authorize that the user can view project members
        $this->authorizeProjectManagement($project);

        $project->load('projectMembers.user');

        return view('projects.members.index', compact('project'));
    }

    /**
     * Show the form for inviting a member.
     */
    public function invite(Project $project)
    {
        // Only project owner or manager can invite members
        $this->authorizeProjectManagement($project);

        return view('projects.members.invite', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        // Only project owner or manager can invite members
        $this->authorizeProjectManagement($project);

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|in:member,manager'
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if user is already a member of the project
        $existingMember = $project->projectMembers()
            ->where('user_id', $user->id)
            ->first();

        if ($existingMember) {
            return redirect()->back()
                ->with('error', 'User sudah menjadi anggota proyek ini.')
                ->withInput();
        }

        // Add the user to the project
        $project->projectMembers()->create([
            'user_id' => $user->id,
            'role' => $request->role,
        ]);

        return redirect()->route('projects.members.index', $project)
            ->with('success', 'Anggota berhasil diundang ke proyek!');
    }

    /**
     * Update the role of a project member.
     */
    public function updateRole(Request $request, Project $project, ProjectMember $projectMember)
    {
        // Only project owner can update member roles
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized to update member roles');
        }

        // Prevent changing the owner's role
        if ($projectMember->user_id === $project->owner_id) {
            abort(403, 'Cannot change owner role');
        }

        $request->validate([
            'role' => 'required|in:member,manager'
        ]);

        $projectMember->update([
            'role' => $request->role,
        ]);

        return redirect()->route('projects.members.index', $project)
            ->with('success', 'Peran anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Project $project, ProjectMember $projectMember)
    {
        // Only project owner can remove members
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized to remove members');
        }

        // Prevent removing the owner from the project
        if ($projectMember->user_id === $project->owner_id) {
            abort(403, 'Cannot remove owner from project');
        }

        $projectMember->delete();

        return redirect()->route('projects.members.index', $project)
            ->with('success', 'Anggota berhasil dihapus dari proyek!');
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
