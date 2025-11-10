<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;

    protected $table = 'balita';

    protected $fillable = [
        'nama',
        'nama_ibu',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'berat_lahir',
        'tinggi_lahir',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'berat_lahir' => 'decimal:2',
        'tinggi_lahir' => 'decimal:2',
    ];

    public function getJenisKelaminTextAttribute()
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }
}

