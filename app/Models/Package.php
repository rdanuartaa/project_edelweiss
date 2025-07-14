<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'latitude',
        'longitude',
        'banner',
        'poster',
    ];

    public function options() {
    return $this->hasMany(PackageDetail::class);
    }

    public function schedules()
    {
        return $this->hasMany(PackageSchedule::class);
    }

}
