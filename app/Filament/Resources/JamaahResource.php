<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JamaahResource\Pages;
use App\Filament\Resources\JamaahResource\RelationManagers;
use App\Models\Jamaah;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class JamaahResource extends Resource
{
    protected static ?string $model = Jamaah::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $title = 'Jamaah';
    protected ?string $heading = 'Jamaah';
    protected static ?string $slug = 'Jamaah';
    protected static ?string $navigationLabel = 'Jamaah';
    public function getTitle(): string | Htmlable
    {
        return __('Jamaah');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_kepala_keluarga')
                    ->required()
                    ->maxLength(255),
                TextInput::make('jumlah_keluarga')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                Textarea::make('alamat')
                    ->required(),
                TextInput::make('masjid_id')->default(Auth::user()->masjid_id)
                    ->required()->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kepala_keluarga'),
                TextColumn::make('jumlah_keluarga'),
                TextColumn::make('alamat'),
                TextColumn::make('masjid.nama_masjid'),
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
            'index' => Pages\ListJamaahs::route('/'),
            'create' => Pages\CreateJamaah::route('/create'),
            'edit' => Pages\EditJamaah::route('/{record}/edit'),
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
