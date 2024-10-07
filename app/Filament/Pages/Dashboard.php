<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Illuminate\Support\Facades\Auth;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form->schema([
            DateTimePicker::make('startDate')->label('tanggal mulai'),
            DateTimePicker::make('endDate')->label('tanggal akhir')
        ]);
    }

    public static function canAccess(): bool
    {
        return Auth::User()->email != "digimos@admin.com";
    }
}
