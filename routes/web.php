<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KeuanganControlller;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\transaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});
Route::get('/Search', [SearchController::class, 'index'])->name('search');

Route::get('/Masjid/{id}', [MasjidController::class, 'show'])->name('Beranda');
Route::get('/Masjid/{id}/Inventaris', [MasjidController::class, 'inventaris'])->name('Inventaris');
Route::get('/Masjid/{id}/Berita', [MasjidController::class, 'Berita'])->name('Berita');
Route::get('/Masjid/{id}/Keuangan', [KeuanganControlller::class, 'index'])->name('Keuangan');
Route::get('/Masjid/{id}/Pengurus', [MasjidController::class, 'Pengurus'])->name('Pengurus');
Route::get('/Berita/{slug}', [BeritaController::class, 'index'])->name('detailBerita');

Route::get('downloadlaporan/{id}', [transaksiController::class, 'download'])->name('downloadlaporan');
