<?php

namespace App\Filament\Resources\SaldoResource\Pages;

use App\Filament\Resources\SaldoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateSaldo extends CreateRecord
{
    protected static string $resource = SaldoResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['masjid_id'] = Auth::user()->masjid_id;
        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
