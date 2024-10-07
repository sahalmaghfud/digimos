<?php

namespace App\Filament\Resources\JamaahResource\Pages;

use App\Filament\Resources\JamaahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJamaah extends EditRecord
{
    protected static string $resource = JamaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
