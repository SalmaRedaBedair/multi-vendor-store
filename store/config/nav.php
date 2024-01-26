<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'active'=>'dashboard'
    ],
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'badge' => 'new',
        'active'=>'categories.*'
    ],
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.categories.index',
        'title' => 'Products',
        'active'=>'products.*'
    ],
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.categories.index',
        'title' => 'Orders',
        'active'=>'orders.*'
    ]
];
