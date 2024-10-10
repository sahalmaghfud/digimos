<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected static function booted()
    {
        static::created(function ($transaksi) {
            // Cari Saldo berdasarkan Saldo_id yang dikirimkan
            $Saldo = Saldo::find($transaksi->Saldo_id);

            if ($Saldo) {
                // Update Saldo berdasarkan jenis transaksi
                if ($transaksi->jenis_transaksi == 'masuk') {
                    $Saldo->jumlah += $transaksi->jumlah;
                } elseif ($transaksi->jenis_transaksi == 'keluar') {
                    $Saldo->jumlah -= $transaksi->jumlah;
                }

                // Simpan perubahan Saldo
                $Saldo->save();
            }
        });
    }

    function Masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class);
    }

    public function Saldo(): BelongsTo
    {
        return $this->belongsTo(Saldo::class, 'Saldo_id');
    }



    protected $fillable = [
        'masjid_id',
        'Saldo_id',
        'jenis_transaksi',
        'jumlah',
        'keterangan'

    ];

    use HasFactory;
}
