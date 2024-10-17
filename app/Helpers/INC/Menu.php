<?php
$data = [
    [
        'title'         => 'Settings',
        'icon'          => 'settings',
        'order'         => 1,
        'permission'    => 'settings',
        'items'         => [
            [
                'title'         => 'General Settings',
                'url'           => route('app.settings.config'),
                'permission'    => 'config'
            ],
        ]
    ],
    [
        'title'         => 'Roles',
        'icon'          => 'clipboard',
        'order'         => 2,
        'permission'    => 'roles',
        'items'         => [
            [
                'title'         => 'All Roles',
                'url'           => route('app.roles.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Role',
                'url'           => route('app.roles.create'),
                'permission'    => 'create'
            ]
        ],
    ],
    [
        'title'         => 'Admins',
        'icon'          => 'user-check',
        'order'         => 3,
        'permission'    => 'admins',
        'items'         => [
            [
                'title'         => 'All Admins',
                'url'           => route('app.admins.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Activations',
                'url'           => route('app.admins.index').'?type=active',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Un Activations',
                'url'           => route('app.admins.index').'?type=unactive',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Deleted',
                'url'           => route('app.admins.index').'?type=deleted',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Admin',
                'url'           => route('app.admins.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Clients',
        'icon'          => 'users',
        'order'         => 4,
        'permission'    => 'clients',
        'items'         => [
            [
                'title'         => 'All Clients',
                'url'           => route('app.clients.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Activations',
                'url'           => route('app.clients.index').'?type=active',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Un Activations',
                'url'           => route('app.clients.index').'?type=unactive',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Deleted',
                'url'           => route('app.clients.index').'?type=deleted',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Client',
                'url'           => route('app.clients.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Freelancers',
        'icon'          => 'users',
        'order'         => 5,
        'permission'    => 'freelancers',
        'items'         => [
            [
                'title'         => 'All Freelancers',
                'url'           => route('app.freelancers.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Activations',
                'url'           => route('app.freelancers.index').'?type=active',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Un Activations',
                'url'           => route('app.freelancers.index').'?type=unactive',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Deleted',
                'url'           => route('app.freelancers.index').'?type=deleted',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Freelancer',
                'url'           => route('app.freelancers.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Countries',
        'icon'          => 'map',
        'order'         => 6,
        'permission'    => 'countries',
        'items'         => [
            [
                'title'         => 'All Countries',
                'url'           => route('app.countries.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Country',
                'url'           => route('app.countries.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Activities',
        'icon'          => 'hash',
        'order'         => 7,
        'permission'    => 'activities',
        'items'         => [
            [
                'title'         => 'All Activities',
                'url'           => route('app.activities.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Activity',
                'url'           => route('app.activities.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Projects',
        'icon'          => 'bookmark',
        'order'         => 8,
        'permission'    => 'projects',
        'items'         => [
            [
                'title'         => 'All Projects',
                'url'           => route('app.projects.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Project',
                'url'           => route('app.projects.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Invoices',
        'icon'          => 'credit-card',
        'order'         => 9,
        'permission'    => 'invoices',
        'items'         => [
            [
                'title'         => 'All Invoices',
                'url'           => route('app.invoices.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Invoice',
                'url'           => route('app.invoices.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Quotations',
        'icon'          => 'dollar-sign',
        'order'         => 10,
        'permission'    => 'quotations',
        'items'         => [
            [
                'title'         => 'All Quotations',
                'url'           => route('app.quotations.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Quotation',
                'url'           => route('app.quotations.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Expenses',
        'icon'          => 'dollar-sign',
        'order'         => 11,
        'permission'    => 'expenses',
        'items'         => [
            [
                'title'         => 'All Expenses',
                'url'           => route('app.expenses.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Quotation',
                'url'           => route('app.expenses.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Emails',
        'icon'          => 'mail',
        'order'         => 12,
        'permission'    => 'emails',
        'items'         => [
            [
                'title'         => 'All Emails',
                'url'           => route('app.emails.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Send Email',
                'url'           => route('app.emails.send'),
                'permission'    => 'send'
            ]
        ]
    ],
];
return $data;
