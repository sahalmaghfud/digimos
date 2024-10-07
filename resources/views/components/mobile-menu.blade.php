<div id="menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden md:hidden"></div>
<div id="mobile-menu"
    class="fixed inset-y-0 left-0 w-64 bg-green-800 text-white transform -translate-x-full transition-transform duration-300 ease-in-out z-10 md:hidden">
    <button id="close-menu" class="absolute top-4 right-4 text-white"></button>
    <ul class="flex flex-col space-y-4 mt-12 text-lg p-4">
        <li>
            <a href="{{ route('Beranda', $masjid->id) }}" class="text-white hover:text-green-400">Beranda</a>
        </li>
        <li>
            <a href="{{ route('Inventaris', $masjid->id) }}" class="text-white hover:text-green-400">Inventaris</a>
        </li>
        <li>
            <a href="{{ route('Keuangan', $masjid->id) }}" class="text-white hover:text-green-400">Keuangan</a>
        </li>
        <li>
            <a href="{{ route('Pengurus', $masjid->id) }}" class="text-white hover:text-green-400">Pengurus</a>
        </li>
        <li>
            <a href="{{ route('Berita', $masjid->id) }}" class="text-white hover:text-green-400">Berita</a>
        </li>
    </ul>
</div>
