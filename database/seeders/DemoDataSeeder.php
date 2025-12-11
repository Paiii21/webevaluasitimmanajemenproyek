<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectEvaluation;
use App\Models\ProjectInvitation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Single source of truth for all demo data
     * Creates:
     * - 30 users across 7 departments
     * - 8 projects with different owners
     * - Project members with various roles
     * - Pending invitations
     * - Comprehensive evaluations with realistic metrics
     */
    public function run(): void
    {
        // ========== USERS ==========
        $users = $this->createUsers();

        // ========== PROJECTS ==========
        $projects = $this->createProjects($users);

        // ========== PROJECT MEMBERS ==========
        $this->addProjectMembers($projects, $users);

        // ========== PENDING INVITATIONS ==========
        $this->addInvitations($projects);

        // ========== EVALUATIONS ==========
        $this->createEvaluations($projects);

        // Summary
        $this->command->info('');
        $this->command->info('✓ Demo data seeded successfully!');
        $this->command->info('  - 30 users created');
        $this->command->info('  - 8 projects created');
        $this->command->info('  - Project members assigned');
        $this->command->info('  - Pending invitations created');
        $this->command->info('  - Evaluations generated');
        $this->command->info('');
    }

    /**
     * Create 30 users across 7 departments
     */
    private function createUsers(): array
    {
        $departments = ['Engineering', 'Design', 'Marketing', 'Sales', 'Product', 'HR', 'Finance'];
        $users = [];

        for ($i = 1; $i <= 30; $i++) {
            $dept = $departments[($i - 1) % count($departments)];
            $users[] = User::create([
                'name' => "User {$i} ({$dept})",
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }

        return $users;
    }

    /**
     * Create 8 projects with different owners
     */
    private function createProjects(array $users): array
    {
        $projectData = [
            [
                'name' => 'Website Redesign 2025',
                'description' => 'Complete redesign of company website with modern UI/UX principles'
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Building native mobile applications for iOS and Android platforms'
            ],
            [
                'name' => 'Data Migration Initiative',
                'description' => 'Migrating legacy data systems to modern cloud infrastructure'
            ],
            [
                'name' => 'Customer Portal Launch',
                'description' => 'New customer self-service portal with advanced features'
            ],
            [
                'name' => 'Analytics Dashboard',
                'description' => 'Real-time analytics and reporting dashboard implementation'
            ],
            [
                'name' => 'Security Audit & Upgrade',
                'description' => 'Comprehensive security audit and system hardening'
            ],
            [
                'name' => 'Performance Optimization',
                'description' => 'Optimize database queries and improve application performance'
            ],
            [
                'name' => 'AI Integration Project',
                'description' => 'Integrate artificial intelligence for predictive analytics'
            ],
        ];

        $projects = [];
        foreach ($projectData as $index => $data) {
            $projects[] = Project::create([
                'owner_id' => $users[$index]->id,
                'name' => $data['name'],
                'description' => $data['description'],
                'created_at' => now()->subDays(rand(10, 60)),
                'updated_at' => now()->subDays(rand(0, 10)),
            ]);
        }

        return $projects;
    }

    /**
     * Add members to projects
     */
    private function addProjectMembers(array $projects, array $users): void
    {
        foreach ($projects as $project) {
            // Add owner as member
            ProjectMember::create([
                'project_id' => $project->id,
                'user_id' => $project->owner_id,
                'role' => 'owner',
                'created_at' => $project->created_at,
            ]);

            // Add 4-6 random members per project
            $memberCount = rand(4, 6);
            $availableUsers = array_filter($users, fn($u) => $u->id !== $project->owner_id);
            $selectedUsers = array_slice($availableUsers, 0, $memberCount);

            foreach ($selectedUsers as $user) {
                ProjectMember::create([
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                    'role' => rand(0, 1) ? 'manager' : 'member',
                    'created_at' => $project->created_at->addDays(rand(0, 20)),
                ]);
            }
        }
    }

    /**
     * Add pending invitations to projects
     */
    private function addInvitations(array $projects): void
    {
        foreach ($projects as $project) {
            $inviteCount = rand(1, 3);
            for ($i = 0; $i < $inviteCount; $i++) {
                ProjectInvitation::create([
                    'project_id' => $project->id,
                    'email' => "invited-{$project->id}-{$i}@example.com",
                    'inviter_id' => $project->owner_id,
                    'role' => rand(0, 1) ? 'member' : 'manager',
                    'created_at' => now()->subDays(rand(1, 15)),
                ]);
            }
        }
    }

    /**
     * Create evaluations for project members
     */
    private function createEvaluations(array $projects): void
    {
        $notes = [
            'Excellent performance this quarter. Shows strong leadership and communication skills.',
            'Good work overall. Could improve on deadline management in some areas.',
            'Demonstrates great technical skills and problem-solving abilities.',
            'Strong collaboration with team members. Positive attitude and commitment.',
            'Needs improvement on time management. Otherwise performing well.',
            'Outstanding contribution to project goals. Keep up the great work!',
            'Shows initiative and takes ownership of tasks. Very reliable team member.',
            'Participates actively in team discussions. Could be more proactive.',
            'Exceptional problem-solving skills demonstrated across multiple projects.',
            'Good technical knowledge. Excellent team player with positive energy.',
        ];

        foreach ($projects as $project) {
            $members = $project->projectMembers;
            $evaluationCount = rand(3, 8);

            for ($e = 0; $e < $evaluationCount; $e++) {
                // Get evaluator (manager or owner)
                $managers = $members->filter(fn($m) => in_array($m->role, ['owner', 'manager']));
                $evaluator = $managers->isNotEmpty() ? $managers->random()->user : $members->first()->user;

                // Get member to evaluate (someone different from evaluator)
                $evaluatee = $members->where('user_id', '!=', $evaluator->id)->random();

                if ($evaluatee) {
                    ProjectEvaluation::create([
                        'project_id' => $project->id,
                        'team_member_id' => $evaluatee->user_id,
                        'evaluator_id' => $evaluator->id,
                        'nama_tim' => $evaluatee->user->name,
                        'efektivitas_sistem' => rand(55, 95),
                        'produktivitas_tim' => rand(60, 100),
                        'catatan' => $notes[array_rand($notes)],
                        'created_at' => $project->created_at->addDays(rand(0, 40)),
                        'updated_at' => now()->subDays(rand(0, 40)),
                    ]);
                }
            }
        }
    }
}
