<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarisResource\Pages;
use App\Filament\Resources\InventarisResource\RelationManagers;
use App\Models\Inventaris;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class InventarisResource extends Resource
{
    protected static ?string $model = Inventaris::class;

    protected static ?string $navigationIcon = 'heroicon-m-archive-box';

    protected static ?string $title = 'Inentaris';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    TextInput::make('nama_barang')
                        ->required()
                        ->maxLength(255),
                    Select::make('kondisi')
                        ->required()
                        ->options([
                            'baik' => 'Baik',
                            'rusak_ringan' => 'Rusak Ringan',
                            'rusak_berat' => 'Rusak Berat',
                            'butuh_perbaikan' => 'Butuh Perbaikan',
                        ])
                        ->label('Kondisi'),

                ]),

                Grid::make()->schema([
                    TextInput::make('masjid_id')->default(Auth::user()->masjid_id)
                        ->required()->hidden(),
                    TextInput::make('jumlah')
                        ->numeric()
                        ->required()
                        ->minValue(1),

                    TextInput::make('jumlah_harga')
                        ->required()
                        ->numeric()
                        ->maxLength(15),
                ]),
                Grid::make()->schema([
                    DatePicker::make('tanggal_pembelian')->label('Tanggal Pembelian')
                ]),

                FileUpload::make('foto_barang')
                    ->label('Foto Barang')->disk('public')->directory('gambar_inventaris')->imageEditor()->image()->maxSize(2048),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('masjid.nama_masjid')->label('Nama Masjid'),
                TextColumn::make('nama_barang')->label('Nama Barang'),
                TextColumn::make('jumlah')->label('Jumlah'),
                Tables\Columns\TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'baik' => 'success',               // Hijau untuk kondisi Baik
                        'rusak_ringan' => 'warning',       // Kuning untuk kondisi Rusak Ringan
                        'rusak_berat' => 'danger',         // Merah untuk kondisi Rusak Berat
                        'butuh_perbaikan' => 'secondary',  // Abu-abu untuk kondisi Butuh Perbaikan
                        default => 'secondary',            // Warna default jika tidak ada yang cocok
                    }),
                TextColumn::make('jumlah_harga')->label('Harga')->money('idr'),
                ImageColumn::make('foto_barang')
                    ->label('Foto Barang')
                    ->square()
                    ->size(50)->default('tidak ada foto'),
                TextColumn::make('tanggal_pembelian')->label('Tanggal Beli'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListInventaris::route('/'),
            'create' => Pages\CreateInventaris::route('/create'),
            'edit' => Pages\EditInventaris::route('/{record}/edit'),
        ];
    }
    public static function canAccess(): bool
    {
        return Auth::User()->email != "digimos@admin.com";
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('masjid_id', Auth::user()->masjid_id);
    }
}
