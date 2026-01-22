<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumus extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_rumus', 
        'kategori', 
        'isi_rumus'
    ];
}
