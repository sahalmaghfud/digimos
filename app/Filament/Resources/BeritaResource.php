<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource\RelationManagers;
use App\Models\Berita;
use App\Models\User;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $title = 'Berita';
    protected static ?string $navigationLabel = 'Berita';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('gambar')
                    ->label('Gambar')->disk('public')->directory('gambar_berita')->imageEditor()->image()->maxSize(2048),
                TextInput::make('judul_berita')
                    ->required()
                    ->maxLength(255)->live(onBlur: true)->afterStateUpdated(
                        function (string $operation, $state, Set $set) {
                            if ($operation == 'edit') {
                                return;
                            }

                            $set('slug', Str::slug($state) . '-' . Str::random(3));
                        }
                    ),
                Hidden::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                RichEditor::make('isi_berita')->disableToolbarButtons([
                    'attachFiles',
                    'strike',
                ])
                    ->required(),
                DatePicker::make('tanggal_publikasi')
                    ->required()
                    ->default(now())->readonly(), // Default ke tanggal sekarang

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul_berita')
                    ->label('Judul Berita')
                    ->sortable()
                    ->searchable()->limit(20),


                TextColumn::make('tanggal_publikasi')
                    ->label('Tanggal Publikasi')
                    ->sortable(),
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
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
