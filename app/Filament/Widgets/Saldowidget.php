<?php

namespace App\Filament\Widgets;

use App\Models\Saldo;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class Saldowidget extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Saldo';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // Mengambil data saldo berdasarkan masjid_id pengguna yang sedang login
        $saldos = Saldo::where('masjid_id', Auth::user()->masjid_id)->get();

        // Membuat array untuk data dan label
        $dataValues = [];
        $labels = [];

        foreach ($saldos as $saldo) {
            $dataValues[] = $saldo->jumlah; // Ambil nilai jumlah
            $labels[] = $saldo->nama; // Ambil nama sebagai label
        }

        return [
            'datasets' => [
                [
                    'label' => 'Saldo',
                    'data' => $dataValues, // Data jumlah
                    'backgroundColor' => [ // Warna untuk setiap kategori
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#FFCE56',
                    ],
                ],
            ],
            'labels' => $labels, // Label diambil dari nama
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // Mengatur tipe chart menjadi pie
    }
}
