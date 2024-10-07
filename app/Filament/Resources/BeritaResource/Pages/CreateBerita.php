<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use App\Filament\Resources\BeritaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateBerita extends CreateRecord
{
    protected static string $resource = BeritaResource::class;
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
