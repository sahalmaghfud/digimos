<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZakatResource\Pages;
use App\Filament\Resources\ZakatResource\RelationManagers;
use App\Models\Zakat;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ZakatResource extends Resource
{
    protected static ?string $model = zakat::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $title = 'Zakat';
    protected ?string $heading = 'Zakat';
    protected static ?string $slug = 'Zakat';
    protected static ?string $navigationLabel = 'Zakat';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Data Diri")->schema([
                    TextInput::make('nama')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('jumlah_jiwa')
                        ->required()
                        ->numeric()
                        ->minValue(0),
                ]),
                Section::make("Zakat ")->schema([
                    Select::make('jenis_zakat')
                        ->options([
                            'beras' => 'Beras',
                            'uang_tunai' => 'Uang Tunai',
                        ])
                        ->required(),
                    TextInput::make('jumlah')
                        ->required()
                        ->numeric()
                        ->minValue(0),
                ]),

                TextInput::make('masjid_id')->default(Auth::user()->masjid_id)
                    ->hidden(),
                Textarea::make('keterangan'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('jenis_zakat'),
                TextColumn::make('jumlah'),
                TextColumn::make('jumlah_jiwa'),
                TextColumn::make('keterangan'),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([])
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
            'index' => Pages\ListZakats::route('/'),
            'create' => Pages\CreateZakat::route('/create'),
            'edit' => Pages\EditZakat::route('/{record}/edit'),
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
