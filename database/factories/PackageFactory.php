<?php

// database/factories/PackageFactory.php
namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        return [
            'name' => 'Paket Bromo Sunrise',
            'description' => 'Menikmati keindahan matahari terbit di Bromo.',
            'location' => 'Bromo, Jawa Timur',
            'latitude' => -7.9425,
            'longitude' => 112.9530,
            'banner' => 'banner_bromo.jpg',
            'poster' => 'poster_bromo.jpg',
        ];
    }
}
