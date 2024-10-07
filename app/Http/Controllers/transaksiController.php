<?php

namespace App\Http\Controllers;

use App\Exports\transaksiExport;
use Illuminate\Http\Request;

class transaksiController extends Controller
{
    public function download($id)
    {
        return (new transaksiExport($id))->download('laporan.xlsx');
    }
}
