<?php

namespace App\Console\Commands;

use App\Models\Berita;
use App\Models\Inventaris;
use App\Models\Masjid;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteUnusedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:unused-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $masjidsProfil = Masjid::pluck('gambar_profil')->toArray();
        $masjidsSampul = Masjid::pluck('gambar_sampul')->toArray();
        $berita = Berita::pluck('gambar')->toArray();
        $inventaris = Inventaris::pluck('foto_barang')->toArray();

        $filess = array_merge($masjidsProfil, $masjidsSampul, $berita, $inventaris);


        collect(Storage::disk('public')->allFiles())
            ->reject(fn(string $file) => $file === '.gitignore')
            ->reject(fn(string $file) => in_array($file, $filess))
            ->each(fn($file) => Storage::disk('public')->delete($file));
    }
}
