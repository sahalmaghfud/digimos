<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class District extends Model
{
    use HasFactory;
    public function Regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }
    public function Masjid(): HasMany
    {
        return $this->hasMany(Masjid::class);
    }
    protected $fillable = ['code', 'name', 'regency_id', 'lat', 'lng'];
}
