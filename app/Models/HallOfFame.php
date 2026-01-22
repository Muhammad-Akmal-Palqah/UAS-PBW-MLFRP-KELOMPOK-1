<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallOfFame extends Model
{
    use HasFactory;

    // Tambahkan ini agar kolom bisa diisi data
    protected $fillable = [
        'nama_tokoh',
        'foto',
        'deskripsi'
    ];
}