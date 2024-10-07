<?php

namespace App\Filament\Resources\SaldoResource\Pages;

use App\Filament\Resources\SaldoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSaldo extends EditRecord
{
    protected static string $resource = SaldoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
