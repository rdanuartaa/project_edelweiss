<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSchedule extends Model
{
    protected $fillable = [
        'package_id',
        'package_detail_id',
        'date',
        'quota',
        'remaining_quota',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function packageDetail()
    {
        return $this->belongsTo(PackageDetail::class);
    }

}
