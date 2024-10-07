<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Masjid extends Model
{
    protected static function booted()
    {
        static::created(function ($masjid) {
            Saldo::create([
                'masjid_id' => $masjid->id,
                'nama' => 'Kas Pembangunan',
                'jumlah' => 0,
            ]);
            Saldo::create([
                'masjid_id' => $masjid->id,
                'nama' => 'Infaq',
                'jumlah' => 0,
            ]);
        });
    }

    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'id',
        'nama_masjid',
        'linkLokasi',
        'visi',
        'sejarah',
        'misi',
        'gambar_profil',
        'gambar_sampul',
        'luas',
        'isActive',
        'facebook',
        'instagram',
        'whatsapp',
        'alamat',
        'province_id',
        'regency_id',
        'district_id'

    ];

    public function District(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
    public function Regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }
    public function Province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function Saldo(): HasMany
    {
        return $this->hasMany(Saldo::class);
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(transaksi::class);
    }
    public function Pengurus(): HasMany
    {
        return $this->hasMany(Pengurus::class);
    }
    public function Inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class);
    }
    public function Berita(): HasMany
    {
        return $this->hasMany(Berita::class);
    }
    public function Zakat(): HasMany
    {
        return $this->hasMany(zakat::class);
    }



    protected $table = 'masjids';
    protected $casts = [
        'isActive' => 'boolean',
    ];
}
