<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    public function Masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class);
    }
    use HasFactory;

    protected $fillable = [
        'masjid_id',
        'judul_berita',
        'slug',
        'isi_berita',
        'gambar',
        'tanggal_publikasi',
    ];
}
