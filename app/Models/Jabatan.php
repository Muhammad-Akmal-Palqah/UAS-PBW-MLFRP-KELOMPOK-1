<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi manual
    protected $fillable = ['nama_jabatan', 'deskripsi'];
}
