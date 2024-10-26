<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaldoResource\Pages;
use App\Filament\Resources\SaldoResource\RelationManagers;
use App\Models\Saldo;
use Filament\Forms;
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

class SaldoResource extends Resource
{
    protected static ?string $model = Saldo::class;
    protected static ?string $navigationLabel = 'Edit Saldo';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $title = 'Saldo';
    protected ?string $heading = 'Saldo';
    protected static ?string $slug = 'Saldo';

    public function getTitle(): string | Htmlable
    {
        return __('Saldo');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->label('Nama Saldo')->required(),
                TextInput::make('jumlah')->numeric()->label('Masukan Jumlah Pertama')->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->label('Nama Saldo'),
                TextColumn::make('jumlah')->label('Jumlah Saldo')
            ])
            ->filters([
                //
            ])
            ->actions([]);
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
            'index' => Pages\ListSaldos::route('/'),
            'create' => Pages\CreateSaldo::route('/create'),
            'edit' => Pages\EditSaldo::route('/{record}/edit'),
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
