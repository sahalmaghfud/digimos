<?php

namespace App\Filament\Resources\MasjidResource\Pages;

use App\Filament\Resources\MasjidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasjids extends ListRecords
{
    protected static string $resource = MasjidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
