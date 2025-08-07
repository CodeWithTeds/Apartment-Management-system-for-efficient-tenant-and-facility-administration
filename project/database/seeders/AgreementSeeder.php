<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agreement;
use App\Models\User;
use App\Models\SuperAdmin;

class AgreementSeeder extends Seeder
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

        $agreements = [
            [
                'title' => 'Property Management Service Agreement',
                'content' => "This Property Management Service Agreement (the 'Agreement') is entered into on this day between the Super Admin and the Property Owner.

SERVICE SCOPE:
The Super Admin agrees to provide comprehensive property management services including tenant screening, rent collection, maintenance coordination, and financial reporting.

RESPONSIBILITIES:
1. Property Owner Responsibilities:
   - Maintain property in good condition
   - Provide necessary documentation
   - Pay management fees on time

2. Super Admin Responsibilities:
   - Screen and place qualified tenants
   - Handle rent collection and disbursement
   - Coordinate maintenance and repairs
   - Provide monthly financial reports

FEES AND PAYMENTS:
Management fee: 8% of monthly rent
Late payment fee: $50 per occurrence
Maintenance coordination fee: $25 per request

TERM AND TERMINATION:
This agreement is effective for 12 months and may be renewed annually. Either party may terminate with 30 days written notice.

GOVERNING LAW:
This agreement is governed by the laws of the jurisdiction where the property is located.",
                'status' => 'approved',
                'super_admin_id' => $superAdmins->random()->id,
                'admin_id' => $users->random()->id,
                'admin_acknowledged_at' => now()->subDays(5),
                'admin_notes' => 'Agreement approved. All terms are acceptable.',
            ],
            [
                'title' => 'Tenant Lease Agreement Template',
                'content' => "LEASE AGREEMENT TEMPLATE

This property lease agreement has been settled between landlord name: [Property Owner] and tenant name: [Tenant Name] on this day of: [Date] for the period of: [Lease Term].

LEASE/RENT:
Monthly rent: $[Amount]
Due date: [Day] of each month
Late fee: $[Amount] after [Days] days

TERMS:
1. The tenant shall maintain the property in good condition
2. No pets without written permission
3. No subletting without landlord approval
4. Quiet hours from 10 PM to 7 AM
5. No smoking inside the property

PROHIBITED USES:
- Illegal activities
- Excessive noise or disturbances
- Unauthorized modifications
- Commercial use without permission

SUBLEASE & ASSIGNMENTS:
Tenant may not sublet or assign this lease without written landlord consent.

REPAIRS:
Landlord responsible for major repairs and maintenance.
Tenant responsible for minor repairs and cleaning.

ALTERATION OF PROPERTY:
No alterations without written landlord permission.",
                'status' => 'pending',
                'super_admin_id' => $superAdmins->random()->id,
                'admin_id' => $users->random()->id,
            ],
            [
                'title' => 'Maintenance Service Agreement',
                'content' => "MAINTENANCE SERVICE AGREEMENT

This agreement outlines the maintenance services provided by the property management system.

SERVICES INCLUDED:
1. Emergency Repairs (24/7)
   - Plumbing emergencies
   - Electrical issues
   - HVAC failures
   - Security problems

2. Routine Maintenance
   - HVAC filter changes
   - Smoke detector testing
   - Basic plumbing repairs
   - Light fixture replacement

3. Preventive Maintenance
   - Quarterly inspections
   - Annual HVAC service
   - Seasonal maintenance
   - Safety equipment checks

RESPONSE TIMES:
- Emergency: Within 2 hours
- Urgent: Within 24 hours
- Routine: Within 72 hours
- Preventive: Scheduled quarterly

COST STRUCTURE:
- Emergency calls: $100 service fee
- Routine maintenance: $50 per visit
- Preventive maintenance: Included in management fee
- Parts and materials: Additional cost

QUALITY STANDARDS:
All work performed by licensed contractors
Warranty on all repairs for 90 days
Follow-up inspection after major repairs",
                'status' => 'draft',
                'super_admin_id' => $superAdmins->random()->id,
                'admin_id' => $users->random()->id,
            ],
            [
                'title' => 'Financial Reporting Agreement',
                'content' => "FINANCIAL REPORTING AGREEMENT

This agreement establishes the financial reporting requirements between the Super Admin and Property Owner.

REPORTING SCHEDULE:
1. Monthly Reports (Due by 5th of each month)
   - Rent collection summary
   - Expense breakdown
   - Net income calculation
   - Outstanding balances

2. Quarterly Reports (Due within 15 days of quarter end)
   - Detailed financial analysis
   - Year-to-date performance
   - Budget vs. actual comparison
   - Tax preparation summary

3. Annual Reports (Due by January 31st)
   - Complete financial year summary
   - Tax documentation
   - Property value assessment
   - Investment analysis

REPORTING FORMAT:
- PDF format for all reports
- Excel spreadsheets for detailed data
- Online dashboard access
- Email notifications

CONFIDENTIALITY:
All financial information is confidential
Access limited to authorized parties
Secure transmission of all reports",
                'status' => 'approved',
                'super_admin_id' => $superAdmins->random()->id,
                'admin_id' => $users->random()->id,
                'admin_acknowledged_at' => now()->subDays(10),
                'admin_notes' => 'Financial reporting structure looks good. Approved.',
            ],
            [
                'title' => 'Property Inspection Agreement',
                'content' => "PROPERTY INSPECTION AGREEMENT

This agreement outlines the property inspection procedures and requirements.

INSPECTION SCHEDULE:
1. Move-in Inspection
   - Complete property walkthrough
   - Photo documentation
   - Condition assessment
   - Inventory checklist

2. Regular Inspections (Quarterly)
   - General condition check
   - Maintenance needs assessment
   - Safety compliance review
   - Tenant compliance check

3. Move-out Inspection
   - Final condition assessment
   - Damage evaluation
   - Security deposit review
   - Cleaning requirements

INSPECTION PROCESS:
- 24-hour notice required for occupied units
- Tenant may be present during inspection
- Photos taken of all areas
- Written report within 48 hours
- Digital copies provided to all parties

DAMAGE ASSESSMENT:
- Fair market value for repairs
- Professional estimates for major damage
- Tenant responsibility for negligence
- Normal wear and tear excluded",
                'status' => 'pending',
                'super_admin_id' => $superAdmins->random()->id,
                'admin_id' => $users->random()->id,
            ],
        ];

        foreach ($agreements as $agreementData) {
            Agreement::create($agreementData);
        }

        $this->command->info('Agreements seeded successfully!');
    }
}
