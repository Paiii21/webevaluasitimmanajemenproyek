<?php

namespace App\Http\Controllers;

use App\Models\ProjectInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectInvitationController extends Controller
{
    /**
     * Accept an invitation to join a project.
     */
    public function accept($token)
    {
        // Find the invitation by token
        $invitation = ProjectInvitation::where('token', $token)->first();

        if (!$invitation) {
            return redirect()->route('login')
                ->with('error', 'Tautan undangan tidak valid.');
        }

        // Check if invitation has expired
        if ($invitation->isExpired()) {
            return redirect()->route('login')
                ->with('error', 'Undangan ini telah kedaluwarsa.');
        }

        // Check if invitation has already been accepted
        if ($invitation->isAccepted()) {
            return redirect()->route('login')
                ->with('error', 'Undangan ini telah diterima sebelumnya.');
        }

        // If user is already logged in, process the invitation
        if (Auth::check()) {
            return $this->processInvitation($invitation);
        } else {
            // Store the invitation token in session for later processing after login
            session(['pending_invitation_token' => $token]);

            return redirect()->route('login')
                ->with('info', 'Silakan login terlebih dahulu untuk menerima undangan.');
        }
    }

    /**
     * Process the invitation after user authentication.
     */
    private function processInvitation(ProjectInvitation $invitation)
    {
        $user = Auth::user();

        // Check if user's email matches the invitation email
        if ($user->email !== $invitation->email) {
            return redirect()->route('dashboard')
                ->with('error', 'Email tidak cocok dengan undangan.');
        }

        // Add user to the project with the specified role
        $invitation->project->projectMembers()->create([
            'user_id' => $user->id,
            'role' => $invitation->role,
        ]);

        // Mark the invitation as accepted
        $invitation->update([
            'accepted_at' => now(),
        ]);

        return redirect()->route('projects.show', $invitation->project)
            ->with('success', 'Anda berhasil bergabung ke proyek!');
    }
}
