<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index($slug)
    {
        $berita = Berita::where('slug', $slug)->first();


        if (!$berita) {
            return response()->view('errors.404', [], 404); // Redirect to a 404 error page
        }

        // Return a view with the berita data
        return view('berita', compact('berita'));
    }
}
