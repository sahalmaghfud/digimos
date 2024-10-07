<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengurus Masjid</title>
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
        <x-navigation-tabs :currentRoute="'Pengurus'" :masjid="$masjid"></x-navigation-tabs>

        <div class="max-w-full sm:max-w-5xl mx-auto my-14">
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-4 text-center">Daftar Pengurus Masjid
                {{ $masjid->nama_masjid }}</h2>
            <div class="bg-white overflow-hidden rounded-xl border-2">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-green-600 text-white">
                                <th
                                    class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                    Jabatan</th>
                                <th
                                    class="px-3 py-2 sm:px-4 sm:py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                    Kontak</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">


                            @forelse($pengurus as $p)
                                <tr class="hover:bg-green-50 transition duration-150">
                                    <td
                                        class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-xs sm:text-sm font-medium text-slate-900">
                                        {{ $loop->index + 1 }} <!-- Menggunakan $loop->index untuk mendapatkan index -->
                                    </td>
                                    <td
                                        class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-xs sm:text-sm text-slate-700">
                                        {{ $p->nama_pengurus }}
                                    </td>
                                    <td
                                        class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-xs sm:text-sm text-slate-700">
                                        {{ $p->jabatan }}
                                    </td>
                                    <td
                                        class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-xs sm:text-sm text-slate-700">
                                        {{ $p->kontak }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-3 py-2 sm:px-4 sm:py-3 whitespace-nowrap text-xs sm:text-sm text-slate-700 text-center">
                                        Tidak ada data pengurus tersedia.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="h-16"></div>



















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
