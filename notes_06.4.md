# component class 
- we use it when i have to get data from other place (get data from database or config file), i can't use view component here
- if there is a lot of work need before go to view
```php
// config/nav.php
<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'active'=>'dashboard.dashboard'
    ],
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'badge' => 'new',
        'active'=>'dashboard.categories.*'
    ],
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'active'=>'dashboard.products.*'
    ],
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.products.index',
        'title' => 'Orders',
        'active'=>'dashboard.orders.*'
    ]
];
```

```php
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
        $this->items=config('nav'); // that is array defined in config/nav.php
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
```
```php
// in view/component/nav.php
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($items as $item)
            <li class="nav-item">
                <a href="{{ route($item['route']) }}" class="nav-link {{ \Illuminate\Support\Facades\Route::is($item['active'])?'active':'' }}">
                    <i class="{{ $item['icon'] }}"></i>
                    <p>
                        {{ $item['title'] }}
                        @if (isset($item['badge']))
                        <span class="right badge badge-danger">New</span>
                        @endif

                    </p>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
<!-- /.sidebar-menu -->
```
- Once a component class is defined, you can use it in your views by invoking its name as a Blade component.
```php
<x-nav />
```
