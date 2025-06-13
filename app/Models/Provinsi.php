<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = ['nama', 'ibukota', 'latitude', 'longitude'];

    // Relasi One-to-Many: Satu Provinsi memiliki banyak Kabkota
    public function kabkotas()
    {
        return $this->hasMany(Kabkota::class);
    }
}