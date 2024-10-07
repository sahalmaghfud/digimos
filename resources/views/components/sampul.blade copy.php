<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden border-t-4 border-green-600">
        <div class="relative">
            <!-- Cover Image -->
            <img src="{{ asset('storage/' . $masjid->gambar_sampul) }}" alt="Sampul Masjid"
                class="w-full h-56 sm:h-64 md:h-80 object-cover transition duration-300 ease-in-out transform hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-green-900/70 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow-lg">
                    {{ $masjid->nama_masjid }}
                </h1>
            </div>
        </div>
        <div class="p-4 sm:p-6">
            <div class="flex items-center text-gray-700 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <p class="text-sm sm:text-base">{{ $masjid->alamat }}</p>
            </div>
            <div class="mt-4 pt-4 border-t border-green-100">
                <h2 class="text-lg font-semibold text-green-700 mb-2">Jadwal Sholat</h2>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subuh:</span>
                        <span class="font-medium">04:30</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dzuhur:</span>
                        <span class="font-medium">12:00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Ashar:</span>
                        <span class="font-medium">15:30</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Maghrib:</span>
                        <span class="font-medium">18:15</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Isya:</span>
                        <span class="font-medium">19:30</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
