<?php

// database/seeders/PackageSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\PackageDetail;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Bromo Sunrise',
                'description' => 'Paket wisata untuk menikmati sunrise di Bromo.',
                'location' => 'Bromo, Jawa Timur',
                'latitude' => -8.0218747,
                'longitude' => 112.9524384,
                'banner' => 'oESaa7i2ld43dHmATrNtjsobtWCw0ajlufRpJUPQ.jpg',
                'poster' => 'uUrWK6zBPRLH9Cm5vI2z2uBBxUu8aTuN6ToegIqC.jpg',
                'details' => [
                    [
                        'option_name' => 'Reguler',
                        'price' => 300000,
                        'price_type' => 'per_orang',
                        'duration' => '1 Hari'
                    ],
                    [
                        'option_name' => 'Jeep Only',
                        'price' => 500000,
                        'price_type' => 'per_jeep',
                        'duration' => '1 Hari'
                    ]
                ]
            ],
            [
                'name' => 'Lava Tour Semeru',
                'description' => 'Paket wisata Lava Tour Lumajang.',
                'location' => 'Wonokitri, Pasuruan',
                'latitude' => -8.2053197,
                'longitude' => 112.9887186,
                'banner' => 'pronNq5ESVTrhg0poW39uIEEz1hcweJ48daGbJSym43vojiwo.jpg',
                'poster' => 'cdi5ld4zO0YWeLK7ftyBt067Bk9rgbU6z3Shsvif.jpg',
                'details' => [
                    [
                        'option_name' => 'Reguler',
                        'price' => 200000,
                        'price_type' => 'per_orang',
                        'duration' => '1 Hari'
                    ],
                    [
                        'option_name' => 'VIP',
                        'price' => 400000,
                        'price_type' => 'per_orang',
                        'duration' => '1 Hari'
                    ]
                ]
            ],
            [
                'name' => 'ATV Lava Tour Semeru',
                'description' => 'Menjelajahi keindahan Semeru dengan ATV.',
                'location' => 'Pronojiwo, Lumajang, Jawa Timur',
                'latitude' => -8.2053197,
                'longitude' => 112.9887186,
                'banner' => 'uDO1vJNJtK0TEXpbnivH7vlGHWt9eJFFcSgY02zW.jpg',
                'poster' => 'aJiAciT3R4dlfpsb1WxawxR8MGV8XlczY4OBH4XZ.jpg',
                'details' => [
                    [
                        'option_name' => 'Reguler',
                        'price' => 450000,
                        'price_type' => 'per_orang',
                        'duration' => '2 Hari 1 Malam'
                    ],
                    [
                        'option_name' => 'Porter + Tenda',
                        'price' => 750000,
                        'price_type' => 'per_orang',
                        'duration' => '2 Hari 1 Malam'
                    ]
                ]
            ]
        ];

        foreach ($packages as $pkg) {
            $package = Package::create(collect($pkg)->except('details')->toArray());

            foreach ($pkg['details'] as $detail) {
                $package->options()->create($detail);
            }
        }
    }
}
