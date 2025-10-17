<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        $apartments = [
            [
                'name' => 'Deluxe Sea View Suite',
                'description' => 'Luxurious suite with panoramic sea views, modern amenities, and a private balcony.',
                'price' => 180,
                'capacity' => 2,
                'size' => 45,
                'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop',
                'location' => 'Beachfront',
                'features' => ['Wi-Fi','Kitchen','Bathroom','Air Conditioning','TV','Balcony'],
            ],
            [
                'name' => 'Premium Family Apartment',
                'description' => 'Spacious apartment ideal for families, with full kitchen and stunning coastal views.',
                'price' => 250,
                'capacity' => 4,
                'size' => 75,
                'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800&h=600&fit=crop',
                'location' => 'Second row',
                'features' => ['Wi-Fi','Kitchen','Bathroom','Air Conditioning','TV','Washing Machine'],
            ],
            [
                'name' => 'Executive Beach Studio',
                'description' => 'Elegant studio with direct beach access, modern design, and premium finishes.',
                'price' => 150,
                'capacity' => 2,
                'size' => 35,
                'image' => 'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?w=800&h=600&fit=crop',
                'location' => 'Beachfront',
                'features' => ['Wi-Fi','Kitchenette','Bathroom','Air Conditioning','TV'],
            ],
        ];

        foreach ($apartments as $data) {
            Apartment::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}


