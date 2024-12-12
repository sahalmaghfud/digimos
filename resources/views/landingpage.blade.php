<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digimos</title>
    <style>
        @keyframes slideBackground {
            0% {
                background-image: url({{ asset('images/masjid1.jpg') }});
            }

            33% {
                background-image: url({{ asset('images/masjid2.jpg') }});
            }

            67% {
                background-image: url({{ asset('images/masjid3.jpg') }});
            }

            100% {
                background-image: url({{ asset('images/masjid4.jpg') }});
            }
        }

        .bg-slideshow {
            animation: slideBackground 20s ease-in-out infinite;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .nav-link {
            position: relative;
            display: inline-block;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: #38a169;
            left: 0;
            bottom: -5px;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body class="bg-green-50 font-sans leading-relaxed tracking-normal">

    <!-- Navigation Bar -->
    <header id="header"
        class=" fixed w-full z-50 top-0 transition-colors duration-300 bg-gradient-to-b from-black/50 to-transparant">
        <nav class="container mx-auto p-4 flex justify-between items-center">
            <a href="#" class="text-green-600">
                <h1 class="text-lg font-bold text-green-600
 sm:text-2xl">
                    Digimos</h1>
            </a>
            <div class="block lg:hidden">
                <!-- Hamburger Menu Icon -->
                <button id="menu-btn" class="text-black focus:outline-none mx-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <!-- Navigation Menu -->
            <ul id="menu" class="hidden lg:flex space-x-10 ">
                <li><a href="#" class="nav-link text-base  text-white hover:text-green-600 transition">Home</a>
                </li>
                <li><a href="#about-us" class="nav-link text-base text-white hover:text-green-600 transition">About
                        Us</a>
                </li>
                <li><a href="#contact-us" class="nav-link text-base text-white hover:text-green-600 transition">Contact
                        Us</a>
                </li>
                <li><a href="/admin" class="nav-link text-base text-white hover:text-green-600 transition">Login</a>
                </li>
            </ul>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-green-600 p-4">
            <ul class="flex flex-col space-y-4">
                <li><a href="#" class="text-white text-base hover:text-green-300">Home</a></li>
                <li><a href="#about-us" class="text-white text-base hover:text-green-300">About Us</a></li>
                <li><a href="#contact-us" class="text-white text-base hover:text-green-300">Contact Us</a></li>
                <li><a href="/admin" class="text-white text-base hover:text-green-300">Login</a></li>
            </ul>
        </div>
    </header>


    <!-- Hero Section with Search Bar -->
    <section class="flex items-center justify-center h-screen bg-slideshow ">
        <div class="text-center space-y-6 animate-fadeIn w-3/4 md:w-1/3">
            <h1
                class=" font-extrabold text-white leading-tight  text-4xl md:text-5xl drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">
                Digital Mosque
            </h1>
            <p class="text-lg font-bold drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)] text-white">#NgurusMasjidJadiMudah
            </p>
            <form action="{{ route('search') }}" method="GET">
                <div class=" mx-auto relative">
                    <input type="text" placeholder="Cari Masjid" name="query"
                        class="w-full py-3 px-3 pr-12 rounded-full text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-300"
                        id="search-bar">
                    <button class="absolute right-4 top-1/2 transform -translate-y-1/2" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>

        </div>
    </section>



    <section class="py-6 md:py-10 bg-white" id="about-us">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-4xl font-bold text-center text-green-600 mb-6 md:mb-12">Tentang Kami</h2>
            <!-- Deskripsi -->
            <div class="flex flex-col md:flex-row items-center mb-6 md:mb-12">
                <div class="md:w-1/2 pr-0 md:pr-8 mb-6 md:mb-0">
                    <h3 class="text-xl md:text-2xl font-semibold text-green-500 mb-3 md:mb-5">Deskripsi</h3>
                    <p class="text-slate-700 text-sm md:text-base leading-relaxed">
                        Digimos (Digital Mosque) adalah sebuah platform digital yang dirancang khusus untuk
                        mempermudah manajemen masjid secara modern dan terintegrasi. Digimos membantu pengurus masjid
                        mengelola data jamaah, keuangan, donasi, zakat, jadwal kegiatan, serta memberikan akses mudah
                        kepada jamaah untuk terlibat aktif dalam kegiatan masjid. Sistem ini juga mendukung
                        transparansi, keamanan, dan kenyamanan dalam pengelolaan masjid dengan fitur yang dapat diakses
                        kapan saja melalui perangkat mobile. Dengan teknologi inovatif, Digimos memperkuat interaksi
                        antara masjid dan jamaah serta mempercepat pengambilan keputusan strategis melalui data yang
                        terstruktur.
                    </p>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src={{ asset('images/deskripsi.png') }} alt="Deskripsi Perusahaan"
                        class="rounded-lg shadow-lg w-full max-w-lg" />
                </div>
            </div>
            <!-- Keunggulan -->
            <div class="flex flex-col md:flex-row-reverse items-center mb-6 md:mb-12">
                <div class="md:w-1/2 pl-0 md:pl-8 mb-6 md:mb-0">
                    <h3 class="text-xl md:text-2xl font-semibold text-green-500 mb-3 md:mb-5">Keunggulan Kami</h3>
                    <ul class="list-disc list-inside text-slate-700 text-sm md:text-base space-y-2 md:space-y-3">
                        <li>Pengelolaan data masjid terpusat dan terstruktur</li>
                        <li>Transparansi keuangan dengan pencatatan transaksi digital</li>
                        <li>Kemudahan pengelolaan jadwal kegiatan masjid</li>
                        <li>Akses informasi waktu sholat akurat berdasarkan lokasi</li>
                        <li>Pengelolaan donasi dan zakat</li>
                        <li>Integrasi dengan media sosial untuk komunikasi lebih luas</li>
                        <li>Bisa diakses dari berbagai perangkat</li>
                        <li>Dashboard analisis data yang membantu pengambilan keputusan</li>
                        <li>Keamanan data jamaah dan masjid yang terjamin</li>

                    </ul>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src={{ asset('images/keunggulan.png') }} alt="Keunggulan Kami"
                        class="rounded-lg shadow-lg w-full max-w-lg" />
                </div>
            </div>
            <!-- Visi -->
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 pr-0 md:pr-8 mb-6 md:mb-0">
                    <h3 class="text-xl md:text-2xl font-semibold text-green-500 mb-3 md:mb-5">Visi Kami</h3>
                    <p class="text-slate-700 text-sm md:text-base leading-relaxed">
                        Menjadi solusi digital terdepan dalam memfasilitasi manajemen masjid yang efisien, transparan,
                        dan berbasis teknologi, serta memperkuat hubungan antara masjid dan jamaah melalui inovasi yang
                        berkelanjutan, demi kemajuan dan kesejahteraan umat Islam di seluruh dunia.
                    </p>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src={{ asset('images/visi.png') }} alt="Visi Kami"
                        class="rounded-lg shadow-lg w-full max-w-lg " />
                </div>
            </div>
        </div>
    </section>





    <div class="min-h-screen flex flex-col" id="contact-us">
        <div
            class="flex-grow container mx-auto px-4 py-8 flex flex-col md:flex-row items-center md:items-start space-y-8 md:space-y-0 md:space-x-8">
            <div class="w-full md:w-1/2 space-y-6">
                <section>
                    <h2 class="text-2xl font-semibold text-green-600 mb-3">Ingin Bergabung dengan Digimos?</h2>
                    <p class="text-base text-slate-700 mb-4">
                        Kami selalu mencari mitra dan komunitas untuk bergabung dalam pengembangan sistem manajemen
                        masjid yang lebih baik. Jadilah bagian dari revolusi digital masjid dengan Digimos.
                    </p>
                    <img src={{ asset('images/tim.jpg') }} alt="Tim Kami" class="rounded-lg shadow-lg w-auto" />
                </section>
                <section>
                    <h2 class="text-xl font-semibold text-green-600 mb-3">Informasi Kontak</h2>
                    <ul class="space-y-2 text-sm text-slate">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Jl. Jambi Muara Bulian No.KM. 15, Mendalo Darat, Kec. Jambi Luar Kota, Kabupaten Muaro
                            Jambi, Jambi
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            +628 3171 7789 87
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            join@digimos.com
                        </li>
                    </ul>
                </section>

            </div>
            <div
                class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-xl font-semibold text-green-600 mb-4 text-center"></h2>
                <a href="https://forms.gle/eew2iFbcq6QWUYgp8">
                    <button
                        class="w-full py-2 px-4 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 transition-colors duration-300">
                        Daftar
                        Sekarang!</button></a>
            </div>
        </div>
    </div>








    <!-- Footer -->
    <footer class="bg-green-950 text-white py-2">

        <div class="container mx-auto flex flex-col items-center">
            <p class="mb-2">&copy; 2024 Digimos</p>
            <div class="flex space-x-4">

                <a href="https://www.instagram.com/pmw_digimos" target="_blank" class="hover:opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M8 2C4.68629 2 2 4.68629 2 8V16C2 19.3137 4.68629 22 8 22H16C19.3137 22 22 19.3137 22 16V8C22 4.68629 19.3137 2 16 2H8ZM8 4H16C18.2091 4 20 5.79086 20 8V16C20 18.2091 18.2091 20 16 20H8C5.79086 20 4 18.2091 4 16V8C4 5.79086 5.79086 4 8 4ZM17 6C16.4477 6 16 6.44772 16 7C16 7.55228 16.4477 8 17 8C17.5523 8 18 7.55228 18 7C18 6.44772 17.5523 6 17 6ZM12 7C9.23858 7 7 9.23858 7 12C7 14.7614 9.23858 17 12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7ZM12 9C13.6569 9 15 10.3431 15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9Z"
                            fill="currentColor" />
                    </svg>
                </a>

                <a href="https://whatsapp.com" target="_blank" class="hover:opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12C2 13.9778 2.51 15.8443 3.424 17.4387L2.07 22L6.751 20.6738C8.28018 21.5082 10.0649 21.9849 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM17.178 16.249C16.9943 16.7839 16.2825 17.2487 15.6783 17.3753C15.2722 17.4613 14.7454 17.5326 12.4687 16.5855C9.65992 15.4152 7.86297 12.5405 7.73859 12.3686C7.61984 12.1967 6.54609 10.7612 6.54609 9.27464C6.54609 7.78809 7.30055 7.07105 7.56164 6.80371C7.77859 6.57965 8.18016 6.47789 8.56445 6.47789C8.68883 6.47789 8.80176 6.48352 8.90352 6.48633C9.16461 6.49758 9.29453 6.51164 9.46641 6.91883C9.67773 7.42652 10.1934 8.91308 10.252 9.04582C10.3107 9.17856 10.3693 9.35324 10.2861 9.52246C10.209 9.69731 10.1421 9.77246 10.0088 9.92793C9.87539 10.0834 9.75102 10.2054 9.61758 10.3725C9.49602 10.5198 9.35977 10.6783 9.5123 10.9344C9.66484 11.1849 10.1821 12.0073 10.9197 12.6704C11.8717 13.5252 12.6669 13.8094 12.9447 13.931C13.1556 14.0216 13.4056 13.9995 13.5635 13.8276C13.7654 13.6108 14.0127 13.2541 14.2656 12.903C14.4506 12.6417 14.6861 12.608 14.9332 12.6983C15.186 12.783 16.6642 13.512 16.9393 13.6475C17.2143 13.7847 17.3947 13.8495 17.4533 13.9604C17.5119 14.0712 17.5119 14.5501 17.278 16.2491L17.178 16.249Z"
                            fill="currentColor" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>



    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector('.animate-fadeIn').style.animation = "fadeIn 2s ease-out forwards";
        });
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            const links = document.querySelectorAll('.nav-link');
            const scrollPosition = window.scrollY;
            const triggerPosition = 800;

            if (scrollPosition >= triggerPosition) {
                header.classList.add('bg-green-100');
                header.classList.remove('bg-gradient-to-b');
                header.classList.remove('from-black/60');
                header.classList.remove('to-transparent');

                links.forEach(link => link.style.color = 'black');
            } else {
                header.classList.add('bg-gradient-to-b');
                header.classList.add('from-black/60');
                header.classList.add('to-transparent');
                header.classList.remove('bg-green-100');
                links.forEach(link => link.style.removeProperty('color'));
            }
        });

        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!mobileMenu.classList.contains('hidden') && !menuBtn.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>




</body>

</html>
