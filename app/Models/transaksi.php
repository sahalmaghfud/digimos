<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class transaksi extends Model
{
    protected $table = 'transaksis';

    protected static function booted()
    {
        static::created(function ($transaksi) {
            // Cari saldo berdasarkan saldo_id yang dikirimkan
            $saldo = Saldo::find($transaksi->saldo_id);

            if ($saldo) {
                // Update saldo berdasarkan jenis transaksi
                if ($transaksi->jenis_transaksi == 'masuk') {
                    $saldo->jumlah += $transaksi->jumlah;
                } elseif ($transaksi->jenis_transaksi == 'keluar') {
                    $saldo->jumlah -= $transaksi->jumlah;
                }

                // Simpan perubahan saldo
                $saldo->save();
            }
        });
    }

    function Masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class);
    }

    public function saldo(): BelongsTo
    {
        return $this->belongsTo(Saldo::class, 'saldo_id');
    }



    protected $fillable = [
        'masjid_id',
        'saldo_id',
        'jenis_transaksi',
        'jumlah',
        'keterangan'

    ];

    use HasFactory;
}
