<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabkota extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'latitude', 'longitude', 'provinsi_id'];

    // Relasi Many-to-One: Banyak Kabkota dimiliki oleh satu Provinsi
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    // Relasi One-to-Many: Satu Kabkota memiliki banyak Faskes
    public function faskes()
    {
        return $this->hasMany(Faskes::class);
    }
}