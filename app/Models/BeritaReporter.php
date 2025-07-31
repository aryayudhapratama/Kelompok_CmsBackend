<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaReporter extends Model
{
    // Tentukan nama tabel secara eksplisit
    protected $table = 'beritas';

    protected $fillable = [
    'user_id',
    'judul',
    'gambar',
    'konten',
    'nama_reporter',
    'email_reporter',
    'status',
    'is_published',
];


    // Jika ingin relasi
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}