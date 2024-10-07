<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regency extends Model
{

    public function Province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
    public function Masjid(): HasMany
    {
        return $this->hasMany(Masjid::class);
    }

    use HasFactory;
    protected $fillable = ['code', 'name', 'province_id'];
}
