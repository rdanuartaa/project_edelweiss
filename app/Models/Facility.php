<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'package_detail_id'];
    // Relasi jika ada
    public function option() {
    return $this->belongsTo(PackageDetail::class);
    }

}
