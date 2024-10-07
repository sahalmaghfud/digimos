<?php

namespace App\Filament\Resources\JamaahResource\Pages;

use App\Filament\Resources\JamaahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateJamaah extends CreateRecord
{
    protected static string $resource = JamaahResource::class;
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
