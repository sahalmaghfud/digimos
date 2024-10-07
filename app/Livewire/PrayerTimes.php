<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrayerTimes extends Component
{
    public $id;
    public $prayerTimes = [];
    public $date;
    public $error;

    public function mount($id)
    {
        $this->id = $id;
        $this->fetchPrayerTimes();
    }

    public function fetchPrayerTimes()
    {
        $district = DB::table('districts')->where('id', $this->id)->first();
        if (!$district) {
            $this->error = 'District not found';
            return;
        }

        $latitude = $district->lat;
        $longitude = $district->lng;
        $date = Carbon::now()->format('d-m-Y');

        $response = Http::get("http://api.aladhan.com/v1/timings/{$date}", [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);



        if ($response->failed()) {
            $this->error = 'Failed to fetch prayer times';
            return;
        }

        $prayerTimes = $response->json();

        if (!isset($prayerTimes['data']['timings'])) {
            $this->error = 'Prayer times not found';
            return;
        }

        $this->prayerTimes = $prayerTimes['data']['timings'];
        $this->date = $date;
    }

    public function render()
    {
        return view('livewire.prayer-times');
    }
}
