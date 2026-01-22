<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_peminjam',
        'prodi',
        'item_pinjam',
        'waktu_pinjam'
    ];
}