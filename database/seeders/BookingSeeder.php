<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\User;
use App\Models\PackageSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $users = \App\Models\User::pluck('id')->toArray();
        $schedules = PackageSchedule::pluck('id')->toArray();
        $statuses = ['pending', 'paid', 'rejected']; // hanya pakai ini

        foreach (range(1, 20) as $i) {
            $participants = fake()->numberBetween(1, 8);
            $amountPerPerson = fake()->numberBetween(100_000, 250_000);

            Booking::create([
                'user_id' => fake()->randomElement($users),
                'schedule_id' => fake()->randomElement($schedules),
                'booking_code' => 'BK-' . now()->format('ymd') . '-' . strtoupper(Str::random(5)),
                'participants' => $participants,
                'total_amount' => $participants * $amountPerPerson,
                'status' => fake()->randomElement($statuses),
                'transfer_proof' => null, // Atau bisa pakai fake()->imageUrl()
                'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
