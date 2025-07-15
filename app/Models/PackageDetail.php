<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail  extends Model
{
    protected $fillable = [
        'package_id',
        'option_name',
        'price_type',
        'price',
        'duration',
    ];

    public function facilities() {
        return $this->hasMany(Facility::class);
    }

    public function package() {
        return $this->belongsTo(Package::class);
    }
    
    public function schedules() {
        return $this->hasMany(PackageSchedule::class);
    }
}
