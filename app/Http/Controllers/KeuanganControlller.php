<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Http\Request;

class KeuanganControlller extends Controller
{
    public function index($id)
    {
        $masjid = Masjid::where('id', $id)->first();
        $year = now()->year;
        $Saldo = $masjid->Saldo;
        $zberas = $masjid->zakat()->where('jenis_zakat', 'beras')->whereYear('created_at', $year)->sum('jumlah');
        $zuang = $masjid->zakat()->where('jenis_zakat', 'uang')->whereYear('created_at', $year)->sum('jumlah');
        $zorang = $masjid->zakat()->whereYear('created_at', $year)->sum('jumlah_jiwa');

        $transaksi = $masjid->transaksi()->orderBy('created_at', 'desc')->with('Saldo')->get();


        if (!$Saldo) {
            return response()->view('errors.404', [], 404);
        }

        // Return a view with the berita data
        return view('keuangan', [
            'masjid' => $masjid,
            'Saldo' => $Saldo,
            'transaksi' => $transaksi,
            'beras' => $zberas,
            'uang' => $zuang,
            'orang' => $zorang,
        ]);
    }
}
