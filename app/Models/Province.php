<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name'];
    public function Masjid(): HasMany
    {
        return $this->hasMany(Masjid::class);
    }
}
