<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        // Get pending invitations for this project
        $invitations = $project->invitations()->whereNull('accepted_at')->get();

        return view('projects.members.index', compact('project', 'invitations'));
    }

    /**
     * Show the form for inviting a member.
     */
    public function invite(Project $project)
    {
        // Only project owner or manager can invite members
        $this->authorizeProjectManagement($project);

        // Get pending invitations for this project
        $invitations = $project->invitations()->whereNull('accepted_at')->get();

        return view('projects.members.invite', compact('project', 'invitations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        // Only project owner or manager can invite members
        $this->authorizeProjectManagement($project);

        $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:member,manager'
        ]);

        // Check if user already exists in the system
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // Check if user is already a member of the project
            $existingMember = $project->projectMembers()
                ->where('user_id', $existingUser->id)
                ->first();

            if ($existingMember) {
                return redirect()->back()
                    ->with('error', 'User sudah menjadi anggota proyek ini.')
                    ->withInput();
            }

            // Add the existing user to the project
            $project->projectMembers()->create([
                'user_id' => $existingUser->id,
                'role' => $request->role,
            ]);

            return redirect()->route('projects.members.index', $project)
                ->with('success', 'Anggota berhasil ditambahkan ke proyek!');
        } else {
            // Check if an invitation already exists for this email
            $existingInvitation = $project->invitations()
                ->where('email', $request->email)
                ->whereNull('accepted_at')
                ->first();

            if ($existingInvitation) {
                return redirect()->back()
                    ->with('error', 'Undangan sudah dikirim ke email ini.')
                    ->withInput();
            }

            // Create an invitation for unregistered user
            $invitation = ProjectInvitation::create([
                'project_id' => $project->id,
                'email' => $request->email,
                'inviter_id' => Auth::id(),
                'role' => $request->role,
            ]);

            // Send invitation email
            \Mail::to($request->email)->send(new \App\Mail\ProjectInvitationMail($invitation));

            return redirect()->route('projects.members.index', $project)
                ->with('success', 'Undangan berhasil dikirim! Tautan pendaftaran telah dikirim ke email.');
        }
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
     * Remove a pending invitation
     */
    public function removeInvitation(Project $project, ProjectInvitation $invitation)
    {
        // Only project owner can remove invitations
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized to remove invitations');
        }

        // Ensure invitation belongs to the project
        if ($invitation->project_id !== $project->id) {
            abort(403, 'Unauthorized to remove this invitation');
        }

        $invitation->delete();

        return redirect()->route('projects.members.index', $project)
            ->with('success', 'Undangan berhasil dibatalkan!');
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
