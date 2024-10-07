<?php

namespace App\Providers;


use App\View\Components\MobileMenu;
use App\View\Components\NavigationTabs;
use App\View\Components\Sampul;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['id']);
        });

        Blade::component('mobile-menu', MobileMenu::class);
        Blade::component('navigation-tabs', NavigationTabs::class);
        Blade::component('sampul', Sampul::class);
    }
}
