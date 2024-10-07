<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengurus extends Model
{
    use HasFactory;
    protected  $table = 'penguruses';

    public function Masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class);
    }

    protected $fillable = [
        'masjid_id',
        'nama_pengurus',
        'jabatan',
        'kontak',
    ];
}
