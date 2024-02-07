<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\View\Component;

class Nav extends Component
{
    public $items; // i define that item public so i haven't to pass it to view file, laravel will pass it automatically
    public $active;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items=config('nav');
        $this->active=FacadesRoute::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }
}
