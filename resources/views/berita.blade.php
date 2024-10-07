<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Future of Artificial Intelligence</title>
    @vite('resources/css/app.css')
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

    <div id="progress-bar" class="fixed top-0 left-0 w-full h-1 bg-green-500 z-50"></div>

    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">{{ $berita->judul_berita }}</h1>

        <div class="mb-4">
            <p class="text-slate-600">Dipublikasikan Tanggal : <strong>{{ $berita->tanggal_publikasi }}</strong></p>
            <img src="{{ asset('storage/' . $berita->gambar) }}"alt="Gambar tidak tersedia" class=" rounded-md mb-10">
        </div>

        <div class="prose">
            {!! $berita->isi_berita !!}

        </div>
    </div>

    <script>
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('progress-bar').style.width = scrolled + '%';
        });
    </script>
</body>

</html>