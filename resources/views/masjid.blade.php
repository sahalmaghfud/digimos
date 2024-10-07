<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masjid Info</title>
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
        <x-navigation-tabs :currentRoute="'Beranda'" :masjid="$masjid"></x-navigation-tabs>


        <div class="container mx-auto mt-10 my-8 p-4    bg-white shadow-md rounded-lg">
            @livewire('prayer-times', ['id' => $masjid->district_id])
        </div>

        <h1 class="text-2xl font-bold text-center mb-6">PROFIL MASJID</h1>
        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/2">
                <img src="{{ asset('storage/' . $masjid->gambar_profil) }}" alt="Masjid {{ $masjid->nama_masjid }}"
                    class="w-full max-h-96 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-center mt-4">Masjid {{ $masjid->nama_masjid }}</h2>
            </div>

            <div class="md:w-1/2">
                <table class="w-full text-sm border border-green-500 rounded-lg overflow-hidden">
                    <tbody>
                        <tr class="border-b bg-green-200">
                            <td class="py-2 px-4 font-semibold">Nama Masjid</td>
                            <td class="py-2 px-4">: {{ $masjid->nama_masjid }}</td>
                        </tr>
                        <tr class="border-b bg-white">
                            <td class="py-2 px-4 font-semibold">Tahun Berdiri</td>
                            <td class="py-2 px-4">: {{ $masjid->tahun_berdiri }}</td>
                        </tr>
                        <tr class="border-b bg-green-200">
                            <td class="py-2 px-4 font-semibold">Alamat Lengkap</td>
                            <td class="py-2 px-4">{{ $masjid->alamat }}</td>
                        </tr>
                        <tr class="border-b bg-white">
                            <td class="py-2 px-4 font-semibold">Provinsi</td>
                            <td class="py-2 px-4">{{ $masjid->Province->name }}</td>
                        </tr>
                        <tr class="border-b bg-green-200">
                            <td class="py-2 px-4 font-semibold">Kabupaten</td>
                            <td class="py-2 px-4">{{ $masjid->Province->name }}</td>
                        </tr>
                        <tr class="border-b bg-white">
                            <td class="py-2 px-4 font-semibold">Kecamatan</td>
                            <td class="py-2 px-4">{{ $masjid->Province->name }}</td>
                        </tr>
                        <tr class="border-b bg-green-200">
                            <td class="py-2 px-4 font-semibold">Luas</td>
                            <td class="py-2 px-4">{{ $masjid->luas }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <section class="py-10 md:py-20 bg-white" id="about-us">
            <div class="container mx-auto px-4">
                <!-- Visi -->
                <div class="mb-10 ">
                    <h3 class="text-2xl font-semibold text-green-500 mb-4">Visi</h3>
                    <p class="text-slate-700 text-base leading-relaxed">
                        {{ $masjid->visi }}
                    </p>
                </div>

                <!-- Misi -->
                <div class="mb-10 ">
                    <h3 class="text-xl  font-semibold text-green-500 mb-4 ">Misi</h3>
                    <p class="text-slate-700 text-base  leading-relaxed">
                        {{ $masjid->misi }}
                    </p>
                </div>

                <!-- Sejarah -->
                <div>
                    <h3 class="text-xl  font-semibold text-green-500 mb-4 md:mb-6">Sejarah</h3>
                    <p class="text-slate-700 text-base  leading-relaxed">
                        {{ $masjid->sejarah }}
                    </p>
                </div>
            </div>
        </section>




        <div class=" mx-auto my-12 p-6 bg-white shadow-xl rounded-lg">
            <div class="mb-6">
                <h3 class="text-2xl font-bold text-center text-green-700">Lokasi Masjid {{ $masjid->nama_masjid }}</h3>
                <div class="w-16 h-1 bg-green-500 mx-auto mt-2"></div>
            </div>
            <div class="map-container rounded-lg overflow-hidden shadow-lg">
                <iframe src={{ $masjid->linkLokasi }} class="w-full h-96" style="border:0;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
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
