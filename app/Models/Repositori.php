<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repositori extends Model
{
    use HasFactory;

    // Pastikan nama tabel di database adalah 'repositoris' (jamak) 
    // atau tentukan manual jika berbeda:
    protected $table = 'repositoris'; 

    protected $fillable = [
        'judul', 
        'penulis', 
        'keyword',
        'file_jurnal'
    ];
}