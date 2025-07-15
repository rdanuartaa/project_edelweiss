<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'schedule_id',
        'booking_code',
        'participants',
        'total_amount',
        'status',
        'transfer_proof',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(PackageSchedule::class);
    }

    public function details()
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function ticket()
    {
        return $this->hasOne(ETicket::class);
    }

    // App\Models\Booking.php

    public function package()
    {
        return $this->hasOneThrough(
            \App\Models\Package::class,
            \App\Models\PackageSchedule::class,
            'id',            // package_schedules.id
            'id',            // packages.id
            'schedule_id',   // bookings.schedule_id
            'package_id'     // package_schedules.package_id
        );
    }

}

