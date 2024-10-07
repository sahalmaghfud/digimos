<?php

namespace App\Exports;

use App\Models\transaksi;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class transaksiExport implements FromQuery, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $id;
    use Exportable;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return transaksi::query()->where('masjid_id', $this->id)->orderby('created_at', 'desc');
    }

    public function map($transaksi): array
    {
        return [
            Date::dateTimeToExcel($transaksi->created_at),
            $transaksi->saldo->nama,
            $transaksi->jenis_transaksi,
            "Rp. " .  $transaksi->jumlah,
            $transaksi->keterangan,


        ];
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Saldo',
            'Jenis Transaksi',
            'Jumlah Transaksi',
            'Keterangan'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
