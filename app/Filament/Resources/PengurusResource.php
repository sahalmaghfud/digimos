<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengurusResource\Pages;
use App\Filament\Resources\PengurusResource\RelationManagers;
use App\Models\Pengurus;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PengurusResource extends Resource
{
    protected static ?string $model = Pengurus::class;

    protected static ?string $navigationIcon = 'heroicon-m-user-group';
    protected static ?string $title = 'Pengurus';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('masjid_id')->default(Auth::user()->masjid_id)
                    ->required()->hidden(),
                TextInput::make('nama_pengurus')
                    ->required()
                    ->maxLength(255),
                TextInput::make('jabatan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('kontak')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pengurus')->label('Nama Pengurus'),
                TextColumn::make('jabatan')->label('Jabatan'),
                TextColumn::make('kontak')->label('Kontak'),
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
            'index' => Pages\ListPenguruses::route('/'),
            'create' => Pages\CreatePengurus::route('/create'),
            'edit' => Pages\EditPengurus::route('/{record}/edit'),
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
