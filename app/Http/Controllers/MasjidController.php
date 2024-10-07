<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Masjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasjidController extends Controller
{
    public function show($id)
    {
        $masjid = Masjid::where('id', $id)->firstOrFail();
        return view('masjid', compact('masjid'));
    }

    public function inventaris($id)
    {
        $masjid = Masjid::where('id', $id)->firstOrFail();
        $inventaris = $masjid->Inventaris()->paginate(1);

        // Kirim data inventaris ke view
        return view('inventaris', ['masjid' => $masjid, 'inventaris' => $inventaris]);
    }
    public function pengurus($id)
    {
        $masjid = Masjid::where('id', $id)->firstOrFail();
        $pengurus = $masjid->pengurus;

        // Kirim data pengurus ke view
        return view('pengurus', ['masjid' => $masjid, 'pengurus' => $pengurus]);
    }

    public function berita($id)
    {
        $masjid = Masjid::where('id', $id)->firstOrFail();
        $berita = $masjid->berita()->orderBy('created_at', 'desc')->paginate(2);


        // Kirim data berita ke view
        return view('list-berita', ['masjid' => $masjid, 'berita' => $berita]);
    }
}
