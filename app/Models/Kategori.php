<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    // Relasi One-to-Many: Satu Kategori memiliki banyak Faskes
    public function faskes()
    {
        return $this->hasMany(Faskes::class);
    }
}