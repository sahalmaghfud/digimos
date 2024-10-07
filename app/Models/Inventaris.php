<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventaris extends Model
{
    protected $table = 'inventarises';
    use HasFactory;
    public function Masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class);
    }

    protected $fillable = [
        'masjid_id',
        'nama_barang',
        'jumlah',
        'kondisi',
        'jumlah_harga',
        'foto_barang',
        'tanggal_pembelian'
    ];
}
