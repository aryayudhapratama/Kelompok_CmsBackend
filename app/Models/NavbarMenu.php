<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavbarMenu extends Model
{
    use HasFactory;

    // Nama tabel yang akan digunakan
    protected $table = 'navbar_menu';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'title',
        'url',
        'parent_id',
        'order',
        'status_aktif',
    ];

    /**
     * Konversi tipe data kolom secara otomatis.
     */
    protected $casts = [
        'status_aktif' => 'boolean', // BARIS INI TAMBAHAN
    ];

    /**
     * Relasi untuk mendapatkan menu induk.
     */
    public function parent()
    {
        return $this->belongsTo(NavbarMenu::class, 'parent_id');
    }

    /**
     * Relasi untuk mendapatkan sub-menu.
     */
    public function children()
    {
        return $this->hasMany(NavbarMenu::class, 'parent_id')->orderBy('order');
    }

    /**
     * Scope untuk mendapatkan menu utama (yang tidak memiliki parent).
     */
    public function scopeMainMenus($query)
    {
        return $query->whereNull('parent_id')->orWhere('parent_id', 0)->orderBy('order');
    }
}