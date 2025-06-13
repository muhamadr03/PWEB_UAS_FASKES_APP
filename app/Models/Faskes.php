<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faskes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nama_pengelola',
        'alamat',
        'website',
        'email',
        'kabkota_id',
        'rating',
        'latitude',
        'longitude',
        'jenis_faskes_id',
        'kategori_id'
    ];

    // Relasi Many-to-One: Banyak Faskes dimiliki oleh satu Kabkota
    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class);
    }

    // Relasi Many-to-One: Banyak Faskes memiliki satu JenisFaskes
    public function jenisFaskes()
    {
        return $this->belongsTo(JenisFaskes::class);
    }

    // Relasi Many-to-One: Banyak Faskes memiliki satu Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}