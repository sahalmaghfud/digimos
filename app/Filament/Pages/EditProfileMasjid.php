<?php

namespace App\Filament\Pages;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class EditProfileMasjid extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    public ?array $data = [];

    protected static string $view = 'filament.pages.edit-profile-masjid';

    public function mount(): void
    {
        $datas = Auth::user()->Masjid->attributesToArray();
        $this->form->fill($datas);
    }

    public  function form(Form $form): Form
    {
        return $form
            ->schema([
                // Informasi Dasar Masjid






                // Informasi Lokasi
                Section::make('Lokasi')
                    ->schema([
                        Textarea::make('alamat')
                            ->required()
                            ->label('Alamat'),
                        Textarea::make('linkLokasi')
                            ->required()
                            ->label('Link Lokasi'),

                        TextInput::make('luas')
                            ->numeric()
                            ->label('Luas (m²)'),
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

                    ]),

                Section::make("Gambar")->schema([
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
            ])->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            Auth::user()->Masjid->update($data);
        } catch (Halt $exception) {
            return;
        }
        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }

    public static function canAccess(): bool
    {
        return Auth::User()->email != "digimos@admin.com";
    }
}
