<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    use HasFactory;

    protected $table = 'ibu_hamil';

    protected $fillable = [
        'nama',
        'nama_suami',
        'tanggal_lahir',
        'alamat',
        'hpht',
        'telepon',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'hpht' => 'date',
    ];
}

