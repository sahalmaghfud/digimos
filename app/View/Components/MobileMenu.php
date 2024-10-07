<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MobileMenu extends Component
{
    public $masjid;
    /**
     * Create a new component instance.
     */
    public function __construct($masjid)
    {
        $this->masjid = $masjid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mobile-menu');
    }
}
