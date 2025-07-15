<?php

// database/factories/PackageDetailFactory.php
namespace Database\Factories;

use App\Models\PackageDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageDetailFactory extends Factory
{
    protected $model = PackageDetail::class;

    public function definition(): array
    {
        return [
            'option_name' => 'Reguler',
            'price' => 250000,
            'price_type' => 'per_orang',
            'duration' => '1 Hari',
        ];
    }
}
