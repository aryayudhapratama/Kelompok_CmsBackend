<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileManager2 extends Model
{
    use HasFactory;
    protected $table = 'file_managers';
    
        protected $fillable = ['nama', 'slug_path', 'user'];
}
