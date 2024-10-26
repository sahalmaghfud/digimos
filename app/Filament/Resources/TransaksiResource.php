<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Saldo;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TransaksiResource extends Resource
{
    protected static ?string $model = transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(" ")->schema([
                    Select::make('Saldo_id')
                        ->label('Jenis Saldo')
                        ->options(Saldo::where('masjid_id', Auth::user()->masjid_id)->pluck('nama', 'id'))
                        ->live()
                        ->required(),


                    Select::make('jenis_transaksi')
                        ->label('Jenis Transaksi')
                        ->options([
                            'masuk' => 'Masuk',
                            'keluar' => 'Keluar',
                        ])
                        ->required(),
                ]),
                Section::make(" ")->schema([
                    TextInput::make('jumlah')
                        ->label('Jumlah')
                        ->numeric()
                        ->required(),
                    Textarea::make('keterangan')
                        ->label('Keterangan')
                        ->nullable(),
                ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Saldo.nama')
                    ->label('Jenis Saldo')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('jenis_transaksi')
                    ->label('Jenis Transaksi')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'masuk' => 'success',  // Hijau untuk transaksi masuk
                        'keluar' => 'danger',  // Merah untuk transaksi keluar
                        default => 'secondary', // Warna default jika jenis transaksi tidak dikenali
                    })
                    ->sortable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->sortable()
                    ->money('idr'),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->defaultSort("created_at", "desc");
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('masjid_id', Auth::user()->masjid_id);
    }

    public static function canAccess(): bool
    {
        return Auth::User()->email != "digimos@admin.com";
    }
}
