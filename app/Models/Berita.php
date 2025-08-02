<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    // app/Models/Berita.php
protected $fillable = [
    'judul',
    'konten',
    'nama_reporter',
    'email_reporter',
    'gambar',        // ✅ tambahkan ini
    'status',
    'is_published',  // ✅ kalau kolom ini juga ada di DB
];

}
