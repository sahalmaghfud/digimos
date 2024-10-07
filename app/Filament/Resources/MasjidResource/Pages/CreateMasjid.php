<?php

namespace App\Filament\Resources\MasjidResource\Pages;

use App\Filament\Resources\MasjidResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateMasjid extends CreateRecord
{
    protected static string $resource = MasjidResource::class;
}
