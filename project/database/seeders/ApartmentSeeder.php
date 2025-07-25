<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\User;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found, creating a default user.');
            $users = [User::factory()->create()];
        }
        
        Apartment::create([
            'admin_id' => $users->random()->id,
            'name' => 'Sunnyvale Apartments',
            'address' => '123 Main St, Anytown, USA',
            'total_units' => 50,
            'available_units' => 10,
            'capacity' => 4,
            'rent_type' => 'monthly',
            'pet_policy' => 'allowed',
            'description' => 'A beautiful apartment complex with a pool and gym.',
            'image' => null,
            'status' => 'available',
            'location' => 'Anytown',
            'price' => 1200.00,
            'property_type' => 'apartment',
            'amenities' => 'Pool, Gym, Parking',
        ]);
    }
}
