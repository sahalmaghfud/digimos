<div>
    <h1 class="text-sm font-bold ">Waktu Sholat:</h1>
    <p class="text-xs mb-4 text-slate-500">{{ $date }}</p>
    <p class="text-xs text-slate-500">*waktu mungkin tidak 100% tepat</p>
    @if ($error)
        <p>{{ $error }}</p>
    @else
        <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-9 gap-2 text-center">

            <div class="p-2 bg-green-200 rounded shadow">
                <h3 class="text-sm font-bold">Subuh</h3>
                <p class="text-xs">{{ $prayerTimes['Fajr'] }}</p>
            </div>
            <div class="p-2 bg-white rounded shadow">
                <h3 class="text-sm font-bold">Zuhur</h3>
                <p class="text-xs">{{ $prayerTimes['Dhuhr'] }}</p>
            </div>
            <div class="p-2 bg-green-200 rounded shadow">
                <h3 class="text-sm font-bold">Ashar</h3>
                <p class="text-xs">{{ $prayerTimes['Asr'] }}</p>
            </div>
            <div class="p-2 bg-white rounded shadow">
                <h3 class="text-sm font-bold">Maghrib</h3>
                <p class="text-xs">{{ $prayerTimes['Maghrib'] }}</p>
            </div>
            <div class="p-2 bg-green-200 rounded shadow">
                <h3 class="text-sm font-bold">Isya</h3>
                <p class="text-xs">{{ $prayerTimes['Isha'] }}</p>
            </div>
        </div>
    @endif
</div>
