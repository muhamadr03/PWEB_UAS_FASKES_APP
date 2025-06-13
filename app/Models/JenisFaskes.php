<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisFaskes extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti konvensi jamak standar Laravel (misal, 'jenis_faskes' bukan 'jenis_faskes')
    protected $table = 'jenis_faskes';

    protected $fillable = ['nama'];

    // Relasi One-to-Many: Satu JenisFaskes memiliki banyak Faskes
    public function faskes()
    {
        return $this->hasMany(Faskes::class);
    }
}