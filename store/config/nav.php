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
