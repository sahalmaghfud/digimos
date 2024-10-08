<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Saldo extends Model
{
    protected $table = 'Saldos';
    function Masjid(): BelongsTo
    {
        return $this->BelongsTo(Masjid::class);
    }
    public function transaksi(): HasMany
    {
        return $this->hasMany(transaksi::class);
    }

    protected $fillable = [
        'masjid_id',
        'nama',
        'jumlah',
    ];
    use HasFactory;
}
