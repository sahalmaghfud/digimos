<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavigationTabs extends Component
{


    public $masjid;
    public $currentRoute;
    public function __construct($currentRoute, $masjid)
    {
        $this->currentRoute = $currentRoute;
        $this->masjid = $masjid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation-tabs');
    }
}
