<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Finder</title>
    @vite('resources/css/app.css')
    <style>
        .card {
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-slate-100">

    <div id="header"
        class="flex w-full bg-gradient-to-r from-green-500 to-green-400 z-50 h-12 mb-6 rounded-md sticky top-0 items-center transition-transform duration-300">
        <button onclick="history.back()" class="flex-shrink-0 pl-4">
            <svg width="30px" height="30px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                <g id="SVGRepo_iconCarrier">
                    <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z" />
                    <path fill="#000000"
                        d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z" />
                </g>
            </svg>
        </button>
        <div class="flex items-center">
            <img src="{{ asset('images/logoDigimos.png') }}" alt="Logo" class="h-10 object-contain">
            <p class="text-sm font-bold">Digimos</p>
        </div>
    </div>

    <script>
        let lastScrollTop = 0;
        const header = document.getElementById('header');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop) {
                // Scroll ke bawah
                header.style.transform = 'translateY(-100%)';
            } else {
                // Scroll ke atas
                header.style.transform = 'translateY(0)';
            }
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Untuk Mobile or negative scrolling
        });
    </script>





    <div class="container mx-auto px-2 py-6">
        <!-- Search Bar -->
        <div class="mt-6 mb-8">
            <form action="{{ route('search') }}" method="GET" class="w-full max-w-lg">
                <div class="flex items-center">
                    <input type="text" name="query"
                        class="search-input w-full px-4 py-2 border border-slate-300 focus:outline-none focus:ring-2 focus:ring-green-500 rounded-full "
                        placeholder="Cari masjid..." value="{{ request()->input('query') }}">
                    <button type="submit"
                        class="search-button ml-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-full">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
        <!-- Masjid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($masjids as $masjid)
                <a href="{{ route('Beranda', $masjid->id) }}" class="block">
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow duration-300 relative group">
                        <div class="relative h-40 overflow-hidden">
                            <img src="{{ asset('storage/' . $masjid->gambar_profil) }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                alt="{{ $masjid->nama_masjid }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h5
                                class="text-xl font-bold mb-1 group-hover:text-green-600 transition-colors duration-300">
                                {{ $masjid->nama_masjid }}
                            </h5>
                            <p class="text-xs opacity-90 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $masjid->alamat }}
                            </p>
                        </div>
                    </div>
                </a>

            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-slate-500 text-lg">Tidak ada masjid yang ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $masjids->links() }}
    </div>
    <script>
        let lastScrollTop = 0;
        const header = document.getElementById('header');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop) {
                // Scroll ke bawah
                header.style.transform = 'translateY(-100%)';
            } else {
                // Scroll ke atas
                header.style.transform = 'translateY(0)';
            }
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Untuk Mobile or negative scrolling
        });
    </script>
</body>


</html>
