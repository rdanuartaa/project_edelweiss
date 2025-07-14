<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['tag_id', 'judul', 'deskripsi', 'isi', 'gambar'];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}

