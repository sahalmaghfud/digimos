<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    use HasFactory;
    protected $table = 'zakat';
    protected $fillable = [
        'nama',
        'masjid_id',
        'jenis_zakat',
        'jumlah',
        'jumlah_jiwa',
        'keterangan',
    ];
}
