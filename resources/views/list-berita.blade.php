<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berita</title>
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
        <x-navigation-tabs :currentRoute="'Berita'" :masjid="$masjid"></x-navigation-tabs>

        <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-4 text-center">Daftar Berita & Kegiatan Masjid
            {{ $masjid->nama_masjid }}</h2>

        <section class="text-slate-600 body-font overflow-hidden">
            <div class="container px-5 py-24 mx-auto">
                <div class="-my-8 divide-y-2 divide-slate-100">
                    @foreach ($berita as $item)
                        <div class="py-8 flex flex-wrap md:flex-nowrap border-b border-slate-300">
                            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul_berita }}"
                                    class="w-48 h-48 object-cover rounded" />
                            </div>
                            <div class="md:flex-grow">
                                <span class="text-slate-500 text-sm mb-1">{{ $item->tanggal_publikasi }}</span>
                                <h2 class="text-2xl font-medium text-slate-700 title-font mb-2">
                                    {{ \Illuminate\Support\Str::limit($item->judul_berita, 50) }}
                                </h2>
                                <p class="leading-relaxed">
                                    {!! \Illuminate\Support\Str::limit($item->isi_berita, 100) !!}</p>
                                <a href="{{ route('detailBerita', $item->slug) }}"
                                    class="text-green-500 inline-flex items-center mt-4">Baca Selengkapnya
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>







        <div class="mt-6">
            {{ $berita->links() }}

        </div>
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
