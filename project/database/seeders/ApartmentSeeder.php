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
            $user = User::factory()->create();
            $users->push($user);
        }
        
        $apartments = [
            [
                'name' => 'Sunnyvale Apartments',
                'address' => '123 Main St, Anytown, USA',
                'total_units' => 50,
                'available_units' => 10,
                'capacity' => '4 persons',
                'rent_type' => 'Monthly',
                'pet_policy' => 'Allowed',
                'description' => 'A beautiful apartment complex with a pool and gym. Spacious units with modern finishes.',
                'image1' => '1753432615.png',
                'image2' => '1753432801.png',
                'image3' => '1753435506.jpg',
                'image4' => null,
                'image5' => null,
                'status' => 'Active',
                'location' => 'Anytown',
                'price' => 1200.00,
                'property_type' => 'Apartment',
                'amenities' => 'Pool, Gym, Parking',
            ],
            [
                'name' => 'The Grand Residence',
                'address' => '456 Oak Ave, Metro City, USA',
                'total_units' => 100,
                'available_units' => 5,
                'capacity' => '2 persons',
                'rent_type' => 'Monthly',
                'pet_policy' => 'Not Allowed',
                'description' => 'Luxurious living in the heart of the city. Breathtaking views and world-class amenities.',
                'image1' => '1753435743.png',
                'image2' => '1753432615.png',
                'image3' => null,
                'image4' => null,
                'image5' => null,
                'status' => 'Active',
                'location' => 'Metro City',
                'price' => 2500.00,
                'property_type' => 'Condo',
                'amenities' => 'Rooftop Pool, Concierge, Fitness Center, Spa',
            ],
            [
                'name' => 'Cozy Townhouse',
                'address' => '789 Pine Ln, Suburbia, USA',
                'total_units' => 1,
                'available_units' => 1,
                'capacity' => '6 persons',
                'rent_type' => 'Daily',
                'pet_policy' => 'Allowed',
                'description' => 'A charming and spacious townhouse perfect for families. Features a private backyard and garage.',
                'image1' => '1753435506.jpg',
                'image2' => null,
                'image3' => null,
                'image4' => null,
                'image5' => null,
                'status' => 'Active',
                'location' => 'Suburbia',
                'price' => 300.00,
                'property_type' => 'House',
                'amenities' => 'Backyard, Garage, Fireplace',
            ]
        ];

        foreach ($apartments as $apartmentData) {
            Apartment::create(array_merge($apartmentData, ['admin_id' => $users->random()->id]));
        }
    }
}
