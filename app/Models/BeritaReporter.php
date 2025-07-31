<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaReporter extends Model
{
    // Tentukan nama tabel secara eksplisit
    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'konten',
        'nama_reporter',
        'email_reporter',
        'gambar',
        'status',
        'user_id',
    ];

    // Jika ingin relasi
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
