<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\ProjectEvaluation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SpecificUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create specific users
        $users = [];
        $userData = [
            [
                'name' => 'Rayyan',
                'email' => 'rayyan@gmail.com',
            ],
            [
                'name' => 'Fahri',
                'email' => 'fahri@gmail.com',
            ],
            [
                'name' => 'Faiz',
                'email' => 'faiz@gmail.com',
            ],
            [
                'name' => 'Dede',
                'email' => 'dede@gmail.com',
            ],
        ];

        foreach ($userData as $data) {
            $users[$data['email']] = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('11111111'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }

        // Create project with Fahri as owner
        $fahri = $users['fahri@gmail.com'];
        $project = Project::create([
            'owner_id' => $fahri->id,
            'name' => 'Team Project',
            'description' => 'Collaborative project for the team',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add all users as project members
        $members = [];
        foreach ($users as $email => $user) {
            $role = ($user->email === 'fahri@gmail.com') ? 'owner' : 'member';
            
            $members[] = ProjectMember::create([
                'project_id' => $project->id,
                'user_id' => $user->id,
                'role' => $role,
                'created_at' => now(),
            ]);
        }

        // Create evaluations
        $this->createEvaluations($project, $users, $fahri);

        $this->command->info('');
        $this->command->info('✓ Specific users created successfully!');
        $this->command->info('  Users:');
        $this->command->info('    - Rayyan (rayyan@gmail.com)');
        $this->command->info('    - Fahri (fahri@gmail.com) - Project Owner');
        $this->command->info('    - Faiz (faiz@gmail.com)');
        $this->command->info('    - Dede (dede@gmail.com)');
        $this->command->info('');
        $this->command->info('  Project: Team Project');
        $this->command->info('  All users added as project members');
        $this->command->info('  Password for all: 11111111');
        $this->command->info('  Evaluations created');
        $this->command->info('');
    }

    private function createEvaluations($project, $users, $fahri): void
    {
        $notes = [
            'Excellent performance this quarter. Shows strong leadership and communication skills.',
            'Good work overall. Could improve on deadline management in some areas.',
            'Demonstrates great technical skills and problem-solving abilities.',
            'Strong collaboration with team members. Positive attitude and commitment.',
            'Outstanding contribution to project goals. Keep up the great work!',
            'Shows initiative and takes ownership of tasks. Very reliable team member.',
            'Exceptional problem-solving skills demonstrated across multiple projects.',
            'Good technical knowledge. Excellent team player with positive energy.',
        ];

        $evaluatedUsers = ['rayyan@gmail.com', 'faiz@gmail.com', 'dede@gmail.com'];

        foreach ($evaluatedUsers as $email) {
            // Create 2-3 evaluations per user
            $evaluationCount = rand(2, 3);
            
            for ($i = 0; $i < $evaluationCount; $i++) {
                ProjectEvaluation::create([
                    'project_id' => $project->id,
                    'team_member_id' => $users[$email]->id,
                    'evaluator_id' => $fahri->id,
                    'nama_tim' => $users[$email]->name,
                    'efektivitas_sistem' => rand(75, 95),
                    'produktivitas_tim' => rand(80, 100),
                    'catatan' => $notes[array_rand($notes)],
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}
