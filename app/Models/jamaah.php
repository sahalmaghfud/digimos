<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{

    use HasFactory;

    protected $table = 'jamaahs';

    protected $fillable = [
        'nama_kepala_keluarga',
        'jumlah_keluarga',
        'alamat',
        'masjid_id',
    ];
}
