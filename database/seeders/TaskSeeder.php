<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or get primary office users / team members
        $manager = User::firstOrCreate(
            ['email' => 'manager@astgd.com'],
            [
                'name' => 'Sarah Jenkins (Office Manager)',
                'password' => Hash::make('password'),
            ]
        );

        $alex = User::firstOrCreate(
            ['email' => 'alex.developer@astgd.com'],
            [
                'name' => 'Alex Rivera (Senior Engineer)',
                'password' => Hash::make('password'),
            ]
        );

        $emma = User::firstOrCreate(
            ['email' => 'emma.designer@astgd.com'],
            [
                'name' => 'Emma Watson (UI/UX Designer)',
                'password' => Hash::make('password'),
            ]
        );

        $liam = User::firstOrCreate(
            ['email' => 'liam.qa@astgd.com'],
            [
                'name' => 'Liam Chen (QA & Security)',
                'password' => Hash::make('password'),
            ]
        );

        $olivia = User::firstOrCreate(
            ['email' => 'olivia.marketing@astgd.com'],
            [
                'name' => 'Olivia Taylor (Marketing Lead)',
                'password' => Hash::make('password'),
            ]
        );

        // Also assign tasks to any already logged in or existing users
        $allUsers = User::all();
        $primaryUser = $allUsers->first() ?? $manager;

        $tasks = [
            [
                'title' => 'Fix Production Payment Gateway Webhook Latency',
                'description' => 'Investigate and optimize the Stripe webhook listener experiencing 500ms delay during peak hours.',
                'user_id' => $alex->id,
                'assigned_by' => $manager->id,
                'priority' => 'urgent',
                'status' => 'in_progress',
                'category' => 'Engineering',
                'due_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'completed_at' => null,
            ],
            [
                'title' => 'Design ASTGD Mobile Task Tracker Figma Components',
                'description' => 'Create responsive mobile mockups and design token specs for the upcoming employee mobile view.',
                'user_id' => $emma->id,
                'assigned_by' => $manager->id,
                'priority' => 'high',
                'status' => 'in_progress',
                'category' => 'Design',
                'due_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'completed_at' => null,
            ],
            [
                'title' => 'Quarterly Security Audit & Vulnerability Assessment',
                'description' => 'Run automated dependency security scans and audit user permission escalation routines.',
                'user_id' => $liam->id,
                'assigned_by' => $manager->id,
                'priority' => 'high',
                'status' => 'pending',
                'category' => 'Security',
                'due_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'completed_at' => null,
            ],
            [
                'title' => 'Prepare Q3 Office Budget & Hardware Upgrade Report',
                'description' => 'Compile equipment requisitions from engineering and design teams for quarterly procurement approval.',
                'user_id' => $manager->id,
                'assigned_by' => $manager->id,
                'priority' => 'medium',
                'status' => 'pending',
                'category' => 'Operations',
                'due_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'completed_at' => null,
            ],
            [
                'title' => 'Deploy ASTGD Client Onboarding Email Automation Campaign',
                'description' => 'Finalize email copy, configure Mailgun webhook triggers, and verify A/B test split setup.',
                'user_id' => $olivia->id,
                'assigned_by' => $manager->id,
                'priority' => 'medium',
                'status' => 'completed',
                'category' => 'Marketing',
                'due_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'completed_at' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'Database Query Indexing for Task Analytics Dashboard',
                'description' => 'Add compound indices on (status, priority, due_date) to accelerate aggregate reporting queries.',
                'user_id' => $primaryUser->id,
                'assigned_by' => $manager->id,
                'priority' => 'high',
                'status' => 'completed',
                'category' => 'Engineering',
                'due_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'completed_at' => Carbon::now()->subHours(6),
            ],
            [
                'title' => 'Employee Leave Management System Integration',
                'description' => 'Connect internal calendar API with the office attendance tracking system.',
                'user_id' => $alex->id,
                'assigned_by' => $manager->id,
                'priority' => 'low',
                'status' => 'pending',
                'category' => 'Engineering',
                'due_date' => Carbon::now()->addDays(12)->format('Y-m-d'),
                'completed_at' => null,
            ],
            [
                'title' => 'Customer Feedback Survey Analysis Presentation',
                'description' => 'Summarize user satisfaction scores from the July product release into executive slides.',
                'user_id' => $olivia->id,
                'assigned_by' => $manager->id,
                'priority' => 'medium',
                'status' => 'in_progress',
                'category' => 'Marketing',
                'due_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'completed_at' => null,
            ],
        ];

        foreach ($tasks as $taskData) {
            Task::updateOrCreate(
                ['title' => $taskData['title']],
                $taskData
            );
        }
    }
}
