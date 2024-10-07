<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;

class ImportWilayahData extends Command
{
    protected $signature = 'import:wilayah';
    protected $description = 'Import data wilayah from API';

    public function handle()
    {
        $this->importProvinces();
    }

    private function importProvinces()
    {
        $response = Http::get('https://wilayah.id/api/provinces.json');
        $provinces = $response->json('data');

        foreach ($provinces as $province) {
            $prov = Province::updateOrCreate(
                ['code' => $province['code']],
                [
                    'name' => $province['name'],
                    'lat' => $province['coordinates']['lat'] ?? null,
                    'lng' => $province['coordinates']['lng'] ?? null,
                    'google_place_id' => $province['google_place_id'] ?? null,
                ]
            );

            $this->importRegencies($prov->id, $province['code']);
        }
    }

    private function importRegencies($provinceId, $provinceCode)
    {
        $response = Http::get("https://wilayah.id/api/regencies/{$provinceCode}.json");
        $regencies = $response->json('data');

        foreach ($regencies as $regency) {
            $reg = Regency::updateOrCreate(
                ['code' => $regency['code']],
                [
                    'province_id' => $provinceId,
                    'name' => $regency['name'],
                    'lat' => $regency['coordinates']['lat'] ?? null,
                    'lng' => $regency['coordinates']['lng'] ?? null,
                    'google_place_id' => $regency['google_place_id'] ?? null,
                ]
            );

            $this->importDistricts($reg->id, $regency['code']);
        }
    }

    private function importDistricts($regencyId, $regencyCode)
    {
        $response = Http::get("https://wilayah.id/api/districts/{$regencyCode}.json");
        $districts = $response->json('data');

        foreach ($districts as $district) {
            District::updateOrCreate(
                ['code' => $district['code']],
                [
                    'regency_id' => $regencyId,
                    'name' => $district['name'],
                    'lat' => $district['coordinates']['lat'] ?? null,
                    'lng' => $district['coordinates']['lng'] ?? null,
                    'google_place_id' => $district['google_place_id'] ?? null,
                ]
            );
        }
    }
}
