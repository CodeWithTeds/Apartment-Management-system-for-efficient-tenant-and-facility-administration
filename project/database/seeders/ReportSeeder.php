<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;
use App\Models\SuperAdmin;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIn('role', ['owner', 'admin'])->get();
        $superAdmins = SuperAdmin::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found, creating a default user.');
            $user = User::factory()->create(['role' => 'owner']);
            $users->push($user);
        }

        if ($superAdmins->isEmpty()) {
            $this->command->info('No super admins found, creating a default super admin.');
            $superAdmin = SuperAdmin::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@hyslop.com',
                'password' => bcrypt('password'),
            ]);
            $superAdmins->push($superAdmin);
        }

        $reports = [
            [
                'report_name' => 'Monthly Property Performance Report',
                'report_type' => 'Property Analytics',
                'date_range' => 'Last 30 Days',
                'start_date' => now()->subDays(30),
                'end_date' => now(),
                'description' => 'Comprehensive analysis of property performance including occupancy rates, revenue, and maintenance costs.',
                'format' => 'pdf',
                'status' => 'completed',
                'assignable_type' => User::class,
                'assignable_id' => $users->random()->id,
                'file_path' => asset('reports/report-1.pdf'),
                'completed_at' => now()->subDays(2),
            ],
            [
                'report_name' => 'Quarterly Financial Summary',
                'report_type' => 'Financial Report',
                'date_range' => 'Q1 2025',
                'start_date' => now()->startOfQuarter(),
                'end_date' => now()->endOfQuarter(),
                'description' => 'Detailed financial analysis including revenue, expenses, and profit margins for all properties.',
                'format' => 'csv',
                'status' => 'completed',
                'assignable_type' => User::class,
                'assignable_id' => $users->random()->id,
                'file_path' => asset('reports/report-2.csv'),
                'completed_at' => now()->subDays(5),
            ],
            [
                'report_name' => 'Tenant Occupancy Report',
                'report_type' => 'Occupancy Analytics',
                'date_range' => 'Current Month',
                'start_date' => now()->startOfMonth(),
                'end_date' => now()->endOfMonth(),
                'description' => 'Analysis of tenant occupancy rates, turnover, and rental income across all properties.',
                'format' => 'pdf',
                'status' => 'pending',
                'assignable_type' => SuperAdmin::class,
                'assignable_id' => $superAdmins->random()->id,
            ],
            [
                'report_name' => 'Maintenance Request Summary',
                'report_type' => 'Maintenance Report',
                'date_range' => 'Last 60 Days',
                'start_date' => now()->subDays(60),
                'end_date' => now(),
                'description' => 'Summary of all maintenance requests, their status, costs, and completion times.',
                'format' => 'csv',
                'status' => 'completed',
                'assignable_type' => User::class,
                'assignable_id' => $users->random()->id,
                'file_path' => asset('reports/report-4.csv'),
                'completed_at' => now()->subDays(1),
            ],
            [
                'report_name' => 'Annual Property Valuation Report',
                'report_type' => 'Valuation Report',
                'date_range' => '2025',
                'start_date' => now()->startOfYear(),
                'end_date' => now()->endOfYear(),
                'description' => 'Comprehensive property valuation including market analysis, appreciation rates, and investment recommendations.',
                'format' => 'pdf',
                'status' => 'pending',
                'assignable_type' => SuperAdmin::class,
                'assignable_id' => $superAdmins->random()->id,
            ],
            [
                'report_name' => 'Revenue Analysis Report',
                'report_type' => 'Revenue Analytics',
                'date_range' => 'Last 90 Days',
                'start_date' => now()->subDays(90),
                'end_date' => now(),
                'description' => 'Detailed revenue analysis including rental income, additional fees, and payment trends.',
                'format' => 'pdf',
                'status' => 'completed',
                'assignable_type' => User::class,
                'assignable_id' => $users->random()->id,
                'file_path' => asset('reports/report-6.pdf'),
                'completed_at' => now()->subDays(3),
            ],
        ];

        foreach ($reports as $reportData) {
            Report::create($reportData);
        }

        $this->command->info('Reports seeded successfully!');
    }
} 