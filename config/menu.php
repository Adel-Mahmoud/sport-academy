<?php

return [
    [
        'label'  => 'الرئيسية',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-home fa-lg menu-icon"></i>',
        'url'    => '/admin/dashboard',
        // 'badge'  => 1,
        // 'badge-color'  => 'success',
    ],
    [
        'label'  => 'الفروع',
        'type'   => 'dropdown',
        'icon'   => '<i class="fas fa-code-branch fa-lg menu-icon"></i>',
        'children' => [
            ['label' => 'عرض الكل', 'url' => '/admin/branches', 
            // 'can' => 'view branches'
            ],
            ['label' => 'إضافة جديد', 'url' => '/admin/branches/create', // 'can' => 'create branch'
            ],
        ],
        // 'can'    => 'view branches',
    ],
    [
        'label'  => 'الرياضات',
        'type'   => 'dropdown',
        'icon'   => '<i class="fas fa-futbol fa-lg menu-icon"></i>',
        // 'can'    => 'view games',
        'children' => [
            ['label' => 'عرض الكل', 'url' => '/admin/sports', 
            // 'can' => 'view sports'
            ],
            ['label' => 'إضافة جديد', 'url' => '/admin/sports/create', // 'can' => 'create sport'
            ],
        ],
    ],
    [
        'label'  => 'المدربين',
        'type'   => 'dropdown',
        'icon'   => '<i class="fas fa-user-tie fa-lg menu-icon"></i>',
        'children' => [
            ['label' => 'عرض الكل', 'url' => '/admin/coaches'],
            ['label' => 'إضافة جديد', 'url' => '/admin/coaches/create'],
        ],
        // 'can'    => 'view coaches',
    ],
    [
        'label'  => 'اللاعبين',
        'type'   => 'dropdown',
        'icon'   => '<i class="fas fa-users fa-lg menu-icon"></i>',
        'children' => [
            ['label' => 'عرض الكل', 'url' => '/admin/players'],
            ['label' => 'إضافة جديد', 'url' => '/admin/players/create'],
        ],
        // 'can'    => 'view players',
    ],
    [
        'label'  => 'المجموعات',
        'type'   => 'dropdown',
        'icon'   => '<i class="fas fa-layer-group fa-lg menu-icon"></i>',
        'children' => [
            ['label' => 'عرض الكل', 'url' => '/admin/groups'],
            ['label' => 'إضافة جديد', 'url' => '/admin/groups/create'],
        ],
        // 'can'    => 'view groups',
    ],
    [
        'label'  => 'الحضور و الغياب',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-calendar-check fa-lg menu-icon"></i>',
        'url'    => '/admin/attendance',
        // 'can'    => 'view attendance',
    ],
    [
        'label'  => 'التقييمات',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-star fa-lg menu-icon"></i>',
        'url'    => '/admin/evaluations',
        // 'can'    => 'view evaluations',
    ],
    [
        'label'  => 'الاختبارات',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-tasks fa-lg menu-icon"></i>',
        'url'    => '/admin/tests',
        // 'can'    => 'view tests',
    ],
    [
        'label'  => 'الاشتراكات و المدفوعات',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-money-check-alt fa-lg menu-icon"></i>',
        'url'    => '/admin/subscriptions',
        // 'can'    => 'view subscriptions',
    ],
    [
        'label'  => 'الحضور و الانصراف',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-clipboard-list fa-lg menu-icon"></i>',
        'url'    => '/admin/checkin-checkout',
        // 'can'    => 'view checkin-checkout',
    ],
    [
        'label'  => 'المخزن و المنتجات',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-boxes fa-lg menu-icon"></i>',
        'url'    => '/admin/store',
        // 'can'    => 'view store',
    ],
    [
        'label'  => 'المصاريف و التقارير',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-file-invoice-dollar fa-lg menu-icon"></i>',
        'url'    => '/admin/expenses-reports',
        // 'can'    => 'view expenses-reports',
    ],
    [
        'label'  => 'الرواتب',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-money-bill-wave fa-lg menu-icon"></i>',
        'url'    => '/admin/salaries',
        // 'can'    => 'view salaries',
    ],
    [
        'label'  => 'المشتريات  و المصروفات',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-shopping-cart fa-lg menu-icon"></i>',
        'url'    => '/admin/purchases',
        // 'can'    => 'view purchases',
    ],
    [
        'label'  => 'المستخدمين',
        'type'   => 'dropdown',
        'icon'   => '<i class="fas fa-users fa-lg menu-icon"></i>',
        'children' => [
            ['label' => 'عرض الكل', 'url' => '/admin/users', 
            // 'can' => 'view users'
            ],
            ['label' => 'إضافة جديد', 'url' => '/admin/users/create', // 'can' => 'create user'
            ],
        ],
    ],
    [
        'label'  => 'الأدوار والصلاحيات',
        'type'   => 'dropdown',
        'icon'   => '<i class="fas fa-user-shield fa-lg menu-icon"></i>',
        'children' => [
            ['label' => 'عرض الأدوار', 'url' => '/admin/roles', 
            // 'can' => 'view roles'
            ],
            ['label' => 'إضافة دور جديد', 'url' => '/admin/roles/create', 
            // 'can' => 'create role'
            ],
            ['label' => 'عرض الصلاحيات', 'url' => '/admin/permissions',
            // 'can' => 'view permissions'
             ],
            ['label' => 'إضافة صلاحية جديدة', 'url' => '/admin/permissions/create', 
            // 'can' => 'create permission'
            ],
        ],
    ],
    [
        'label'  => 'الإعدادات',
        'type'   => 'link',
        'icon'   => '<i class="fas fa-cog fa-lg menu-icon"></i>',
        'url'    => '/admin/settings',
        // 'can'    => 'view settings',
    ],
];
