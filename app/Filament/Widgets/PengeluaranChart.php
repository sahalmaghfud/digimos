<?php

namespace App\Filament\Widgets;

use App\Models\Saldo;
use App\Models\transaksi;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PengeluaranChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Pengeluaran';
    use InteractsWithPageFilters;

    protected function getData(): array
    {
        $startDate = $this->filters['startDate'];
        $endDate = $this->filters['endDate'];
        $colors = [
            '#FF5733', // Merah
            '#33FF57', // Hijau
            '#3357FF', // Biru
            '#F3FF33', // Kuning
            '#FF33F6', // Magenta
            '#33FFF6', // Cyan
            '#F633FF', // Ungu
            '#FF8C33', // Oranye
            '#33FF8C', // Hijau Muda
            '#8C33FF', // Biru Muda
        ];

        $Saldos = Saldo::where('masjid_id', Auth::user()->masjid_id)->get();

        $pemasukan = [];
        foreach ($Saldos as $Saldo) {
            // Hitung total pemasukan kas untuk setiap Saldo
            $pemasukan[$Saldo->id] = Trend::query(transaksi::where([
                ['jenis_transaksi', '=', 'keluar'],
                ['Saldo_id', '=', $Saldo->id],
                ['masjid_id', '=', Auth::user()->masjid_id]
            ]))
                ->between(
                    start: $startDate ? Carbon::parse($startDate) : now()->subMonth(1),
                    end: $endDate ? Carbon::parse($endDate) : now(),
                )
                ->perDay()
                ->sum('jumlah');
        }

        $datasets = [];
        $labels = [];

        // Loop untuk membangun dataset dan label
        foreach ($pemasukan as $id => $data) {
            $datasets[] = [
                'label' => 'Pengeluaran ' . $Saldos->firstWhere('id', $id)->nama,
                'data' => $data->map->aggregate->toArray(),
                'borderColor' => $colors[($id + 3) % 3],
            ];
            if (empty($labels)) {
                $labels = $data->map->date->toArray();
            }
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    public static function canAccess(): bool
    {
        return Auth::User()->email != "digimos@admin.com";
    }
}
