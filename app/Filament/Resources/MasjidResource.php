<?php

namespace App\Filament\Resources;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;

use App\Filament\Resources\MasjidResource\Pages;
use App\Filament\Resources\MasjidResource\RelationManagers;
use App\Models\Masjid;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class MasjidResource extends Resource
{
    protected static ?string $model = Masjid::class;

    protected static ?string $navigationIcon = 'heroicon-m-moon';

    protected static ?string $title = 'Masjid';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Informasi Dasar Masjid
                Section::make('Informasi Dasar')
                    ->schema([
                        TextInput::make('nama_masjid')
                            ->required()
                            ->label('Nama Masjid'),

                        Textarea::make('linkLokasi')
                            ->required()
                            ->label('Link Lokasi'),

                        TextInput::make('luas')
                            ->numeric()
                            ->label('Luas (m²)'),

                        Toggle::make('isActive')
                            ->label('Status'),
                    ]),

                // Informasi Lokasi
                Section::make('Lokasi')
                    ->schema([
                        Select::make('province_id')
                            ->label('Provinsi')
                            ->options(
                                Province::all()->mapWithKeys(function ($province) {
                                    return [$province->id => $province->name];
                                })->toArray()
                            )
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                $set('regency_id', null);
                                $set('district_id', null);
                            }),

                        Select::make('regency_id')
                            ->label('Kabupaten/Kota')
                            ->options(function (Get $get) {
                                $provinceCode = $get('province_id');
                                if ($provinceCode) {
                                    $provinceId = Province::where('id', $provinceCode)->value('id');
                                    $regencies = Regency::where('province_id', $provinceId)->get();
                                    return $regencies->mapWithKeys(function ($regency) {
                                        return [$regency->id => $regency->name];
                                    })->toArray();
                                }
                                return [];
                            })
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                $set('district_id', null);
                            }),

                        Select::make('district_id')
                            ->label('Kecamatan')
                            ->options(function (Get $get) {
                                $regencyCode = $get('regency_id');
                                if ($regencyCode) {
                                    $regencyId = Regency::where('id', $regencyCode)->value('id');
                                    $districts = District::where('regency_id', $regencyId)->get();
                                    return $districts->mapWithKeys(function ($district) {
                                        return [$district->id => $district->name];
                                    })->toArray();
                                }
                                return [];
                            })
                            ->required(),


                        Textarea::make('alamat')
                            ->required()
                            ->label('Alamat'),
                    ]),

                // Informasi Lainnya
                Section::make('Informasi Lainnya')
                    ->schema([
                        Textarea::make('visi')
                            ->label('Visi'),

                        Textarea::make('sejarah')
                            ->label('Sejarah'),

                        Textarea::make('misi')
                            ->label('Misi'),

                        FileUpload::make('gambar_profil')
                            ->label('Gambar Profil')->disk('public')->directory('gambar_profil')->imageEditor()->image()->maxSize(2048),

                        FileUpload::make('gambar_sampul')
                            ->label('Gambar Sampul')->disk('public')->directory('gambar_sampul')->imageEditor()->image()->maxSize(2048),
                    ]),

                // Informasi Media Sosial
                Section::make('Media Sosial')
                    ->schema([
                        TextInput::make('facebook')
                            ->label('Facebook'),

                        TextInput::make('instagram')
                            ->label('Instagram'),

                        TextInput::make('whatsapp')
                            ->label('WhatsApp'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_masjid')
                    ->label('Nama Masjid')
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('gambar_profil')
                    ->label('Gambar Profil')
                    ->size(50, 50),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMasjids::route('/'),
            'create' => Pages\CreateMasjid::route('/create'),
            'edit' => Pages\EditMasjid::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return Auth::User()->email == "digimos@admin.com";
    }
}
