<div class="hidden md:flex md:flex-wrap  mt-6 p-1 hover:shadow-md ">
    <ul class="flex flex-row md:space-x-6 text-base justify-center md:justify-start">
        <li>
            <a href="{{ route('Beranda', $masjid->id) }}"
                class="tab-link font-bold {{ $currentRoute == 'Beranda' ? 'text-green-700 border-b-4 border-green-700' : 'text-green-500' }} py-2 px-4">Beranda</a>
        </li>
        <li>
            <a href="{{ route('Inventaris', $masjid->id) }}"
                class="tab-link font-bold {{ $currentRoute == 'Inventaris' ? 'text-green-700 border-b-4 border-green-700' : 'text-green-500' }} py-2 px-4 hover:text-green-700 hover:border-b-4 hover:border-green-700">Inventaris</a>
        </li>
        <li>
            <a href="{{ route('Keuangan', $masjid->id) }}"
                class="tab-link font-bold {{ $currentRoute == 'Keuangan' ? 'text-green-700 border-b-4 border-green-700' : 'text-green-500' }} py-2 px-4 hover:text-green-700 hover:border-b-4 hover:border-green-700">Keuangan</a>
        </li>
        <li>
            <a href="{{ route('Pengurus', $masjid->id) }}"
                class="tab-link font-bold {{ $currentRoute == 'Pengurus' ? 'text-green-700 border-b-4 border-green-700' : 'text-green-500' }} py-2 px-4 hover:text-green-700 hover:border-b-4 hover:border-green-700">Pengurus</a>
        </li>
        <li>
            <a href="{{ route('Berita', $masjid->id) }}"
                class="tab-link font-bold {{ $currentRoute == 'Berita' ? 'text-green-700 border-b-4 border-green-700' : 'text-green-500' }} py-2 px-4 hover:text-green-700 hover:border-b-4 hover:border-green-700">Berita</a>
        </li>
    </ul>
</div>
<div class="h-1 w-full bg-slate-200 mb-10">

</div>
