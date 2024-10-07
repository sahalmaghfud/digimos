<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Jika ada pencarian, filter berdasarkan nama masjid
        $masjids = Masjid::when($query, function ($q) use ($query) {
            return $q->where('nama_masjid', 'like', "%{$query}%");
        })->paginate(1)->withQueryString();

        // Mengirimkan query agar tetap muncul di search bar
        return view('search', compact('masjids', 'query'));
    }
}
