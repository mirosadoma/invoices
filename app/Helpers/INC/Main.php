<?php

return [
    [
        'title'         => __('Roles'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.roles.index'),
        'permission'    => 'roles',
        'count'         => \Spatie\Permission\Models\Role::where('guard_name', 'admin')->where('id', '<>', 1)->count()
    ],
    [
        'title'         => __('Admins'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.admins.index'),
        'permission'    => 'admins',
        'count'         => \App\Models\User::where('type', 'admin')->where('id', '<>', 1)->where('is_active', 1)->count()
    ],
    [
        'title'         => __('Clients'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.clients.index'),
        'permission'    => 'clients',
        'count'         => \App\Models\User::where('type', 'client')->where('is_active', 1)->count()
    ],
    [
        'title'         => __('Freelancers'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.freelancers.index'),
        'permission'    => 'freelancers',
        'count'         => \App\Models\User::where('type', 'freelancer')->where('is_active', 1)->count()
    ],
    [
        'title'         => __('Countries'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.countries.index'),
        'permission'    => 'countries',
        'count'         => \App\Models\Countries\Country::where('is_active', 1)->count()
    ],
    [
        'title'         => __('Activities'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.activities.index'),
        'permission'    => 'activities',
        'count'         => \App\Models\Activities\Activity::where('is_active', 1)->count()
    ],
    [
        'title'         => __('Projects'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.projects.index'),
        'permission'    => 'projects',
        'count'         => \App\Models\Projects\Project::where('is_active', 1)->count()
    ],
    [
        'title'         => __('Invoices'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.invoices.index'),
        'permission'    => 'invoices',
        'count'         => \App\Models\Invoices\Invoice::count()
    ],
    [
        'title'         => __('Quotations'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.quotations.index'),
        'permission'    => 'quotations',
        'count'         => \App\Models\Quotations\Quotation::count()
    ],
    [
        'title'         => __('Expenses'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.expenses.index'),
        'permission'    => 'expenses',
        'count'         => \App\Models\Expenses\Expense::count()
    ],
];
