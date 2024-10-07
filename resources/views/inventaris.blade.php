<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masjid Inventaris</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body>

    {{-- hamburger button --}}
    <div class="sticky top-0 left-0 w-full bg-green-600 bg-opacity-70 py-3 rounded-lg z-10   md:hidden">
        <div class="container mx-auto px-4">
            <div class="block">
                <button id="menu-btn" class="focus:outline-none text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <x-header></x-header>
    <div class=" container mx-auto px-4 bg-white">
        <!-- Slide Menu for Mobile -->
        <x-mobile-menu :masjid="$masjid"></x-mobile-menu>
        <x-sampul :masjid="$masjid"></x-sampul>
        <x-navigation-tabs :currentRoute="'Inventaris'" :masjid="$masjid"></x-navigation-tabs>
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-4 text-center">Daftar Inventaris Masjid
            {{ $masjid->nama_masjid }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4">
            @forelse ($inventaris as $item)
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="relative h-48">
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $item->foto_barang) }}"
                            alt="Laptop Dell XPS 13">
                    </div>
                    <div class="p-4">
                        <div class="uppercase tracking-wide text-xs text-indigo-500 font-semibold mb-1">Inventory
                            Item</div>
                        <h2
                            class="text-lg font-semibold text-slate-900 hover:text-indigo-500 transition-colors duration-300 truncate">
                            {{ $item->nama_barang }}
                        </h2>
                        <div class="mt-2 text-sm text-slate-600">
                            <div>Kuantitas: <span class="font-semibold text-slate-800">{{ $item->jumlah }}</span></div>

                            <div>Condition:
                                @if ($item->kondisi == 'baik')
                                    <span class="font-semibold px-2 py-0.5 rounded-full text-green-600 bg-green-100">
                                        Baik
                                    </span>
                                @elseif ($item->kondisi == 'rusak_ringan')
                                    <span class="font-semibold px-2 py-0.5 rounded-full text-yellow-600 bg-yellow-100">
                                        Rusak Ringan
                                    </span>
                                @elseif ($item->kondisi == 'rusak_berat')
                                    <span class="font-semibold px-2 py-0.5 rounded-full text-red-600 bg-red-100">
                                        Rusak Berat
                                    </span>
                                @elseif ($item->kondisi == 'butuh_perbaikan')
                                    <span class="font-semibold px-2 py-0.5 rounded-full text-orange-600 bg-orange-100">
                                        Butuh Perbaikan Segera
                                    </span>
                                @endif
                            </div>



                        </div>
                        <div class="mt-2 text-sm text-slate-600">
                            Price: <span class="font-semibold text-slate-800">Rp 150,000,000</span>
                        </div>
                        <div class="mt-2 text-xs text-slate-500">
                            Purchase Date: <span class="font-semibold text-slate-800">15/09/2024</span>
                        </div>
                    </div>
                </div>
            @empty
                <h3 class="text-2xl font-bold text-center mt-20 text-slate-700">Inventaris Kosong</h3>
            @endforelse

        </div>
        <div class="mt-6">
            {{ $inventaris->links() }}

        </div>




















    </div>
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('menu-btn');
            const closeMenuBtn = document.getElementById('close-menu');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuOverlay = document.getElementById('menu-overlay');


            // Open menu
            menuBtn.addEventListener('click', function() {
                mobileMenu.classList.remove('-translate-x-full');
                menuOverlay.classList.remove('hidden');
            });

            // Close menu
            closeMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.add('-translate-x-full');
                menuOverlay.classList.add('hidden');
            });

            menuOverlay.addEventListener('click', function() {
                mobileMenu.classList.add('-translate-x-full');
                menuOverlay.classList.add('hidden');
            });
        });
    </script>
</body>

</html>
