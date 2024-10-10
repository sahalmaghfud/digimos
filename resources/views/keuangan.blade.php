@php
    $nama = [];
    $jumlah = [];

    foreach ($Saldo as $val) {
        $nama[] = $val->nama;
        $jumlah[] = $val->jumlah;
    }
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masjid Inventaris</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @livewireStyles
    <style>
        /* Mengatur tampilan body tabel */
        #transaksiTable tbody td {
            padding: 1.5vh;
            /* Mengubah padding menjadi vh */
            border: 0.2vh solid #dddddd;
            /* Mengubah border menjadi vh */
        }

        /* Mengatur tampilan baris zebra (selang-seling warna) */
        #transaksiTable tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Mengatur tampilan saat baris tabel dihover */
        #transaksiTable tbody tr:hover {
            background-color: #d1e7dd;
        }
    </style>
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
        <x-navigation-tabs :currentRoute="'Keuangan'" :masjid="$masjid"></x-navigation-tabs>
        <div class="bg-white rounded-lg shadow-md p-6 w-full">
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-4 text-center">Data Keuangan Masjid
                {{ $masjid->nama_masjid }}</h2>
            <h3 class="text-xl sm:text-2 xl font-bold text-slate-800 mb-4">Saldo</h3>
            <div class="flex items-start gap-2  flex-wrap">
                @foreach ($Saldo as $sal)
                    <div class="max-w-sm ">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="px-6 py-4">
                                <h2 class="font-bold text-xl mb-2">{{ $sal->nama }}</h2>
                                <p class="text-slate-700 text-base">
                                    Jumlah Saldo: <span class="font-bold text-green-600">Rp {{ $sal->jumlah }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="w-full  p-6 bg-white">
                <h2 class="text-xl sm:text-2 xl font-bold text-slate-800 mb-4">Distribusi Keuangan Masjid</h2>
                <div class="flex items-center justify-center">
                    <canvas id="pieChart" class="h-40"></canvas>
                </div>
            </div>



            <h2 class="text-xl sm:text-2 xl font-bold text-slate-800 mb-4">Data Transaksi</h2>

            <div class="overflow-x-auto mt-5">
                <table id="transaksiTable" class="w-full border-collapse text-base font-sans">
                    <thead>
                        <tr>
                            <th class="bg-green-500 text-white p-3 border border-slate-300">Tanggal</th>
                            <th class="bg-green-500 text-white p-3 border border-slate-300">Jenis Saldo</th>
                            <th class="bg-green-500 text-white p-3 border border-slate-300">Jenis Transaksi</th>
                            <th class="bg-green-500 text-white p-3 border border-slate-300">Jumlah</th>
                            <th class="bg-green-500 text-white p-3 border border-slate-300">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data rows will be injected here by JavaScript -->
                    </tbody>
                </table>
            </div>


            <div class="flex items-start gap-3 mt-5">
                <button id="prevBtn" onclick="prevPage()" disabled
                    class="bg-slate-200 hover:bg-slate-300 text-green-600 font-bold py-2 px-4 rounded">
                    Sebelumnya
                </button>
                <button id="nextBtn" onclick="nextPage()"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Selanjutnya
                </button>
                <div class="ml-auto">
                    <a href="{{ route('downloadlaporan', $masjid->id) }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Download Excel
                    </a>
                </div>
            </div>
            <h2 class="text-xl sm:text-2 xl mt-5 font-bold text-slate-800 mb-4">Data Zakat Tahun {{ now()->year }}
            </h2>
            <div class="flex flex-wrap justify-start gap-4 p-4">
                <!-- Zakat Beras Card -->
                <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-xs">
                    <div class="flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-center mb-2">Zakat Beras</h2>
                    <p class="text-3xl font-semibold text-center text-blue-600">
                        <span id="zberas">{{ $beras }}</span> kg
                    </p>
                </div>

                <!-- Zakat Uang Card -->
                <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-xs">
                    <div class="flex items-start justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-center mb-2">Zakat Uang</h2>
                    <p class="text-3xl font-semibold text-center text-green-600">
                        Rp <span id="zuang">{{ $uang }}</span>
                    </p>
                </div>

                <!-- Jumlah Jiwa Card -->
                <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-xs">
                    <div class="flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-center mb-2">Jumlah Jiwa</h2>
                    <p class="text-3xl font-semibold text-center text-purple-600">
                        <span id="zorang">{{ $orang }}</span> orang
                    </p>
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
            var labels = @json($nama);
            var chartData = @json($jumlah);
            let randomBackgroundColor = [];
            let usedColors = new Set();

            let dynamicColors = function() {
                let r = Math.floor(Math.random() * 255);
                let g = Math.floor(Math.random() * 255);
                let b = Math.floor(Math.random() * 255);
                let color = "rgb(" + r + "," + g + "," + b + ")";

                if (!usedColors.has(color)) {
                    usedColors.add(color);
                    return color;
                } else {
                    return dynamicColors();
                }
            };
            for (let i in chartData) {
                randomBackgroundColor.push(dynamicColors());
            }


            // Membuat Pie Chart menggunakan Chart.js
            var ctx = document.getElementById('pieChart').getContext('2d');
            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Saldo',
                        data: chartData,
                        backgroundColor: randomBackgroundColor,
                        borderColor: 'rgb(250,250,250)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false
                }
            });

            const data = @json($transaksi);
            console.log(data)

            let currentPage = 0;
            const rowsPerPage = 10;

            function displayTable() {
                const tbody = document.querySelector("#transaksiTable tbody");
                tbody.innerHTML = ""; // Clear previous rows

                const start = currentPage * rowsPerPage;
                const end = start + rowsPerPage;
                const paginatedData = data.slice(start, end);

                paginatedData.forEach(row => {
                    const tr = document.createElement('tr');
                    let createdAt = new Date(row.created_at).toLocaleDateString('en-CA');
                    tr.innerHTML =
                        `<td>${createdAt}</td><td>${row['saldo']['nama']}</td><td>${row.jenis_transaksi}</td><td>Rp.${row.jumlah}</td><td>${row.keterangan}</td>`;
                    tbody.appendChild(tr);
                });

                document.getElementById("prevBtn").disabled = currentPage === 0;
                document.getElementById("nextBtn").disabled = end >= data.length;
            }

            function nextPage() {
                currentPage++;
                displayTable();
            }

            function prevPage() {
                currentPage--;
                displayTable();
            }

            // Display initial data
            displayTable();
        </script>
</body>

</html>
