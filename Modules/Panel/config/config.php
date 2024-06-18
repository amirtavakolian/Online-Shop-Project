<?php

return [
    'items' => [
        [
            'id' => '1',
            'name' => 'دسته بندی ها',
            'class' => 'fas fa-fw fa-folder',
            'url' => url('panel/category')
        ],
        [
            'id' => '2',
            'name' => 'ویژگی ها',
            'class' => 'fas fa-fw fa-table',
            'url' => url('panel/attributes')
        ],
        [
            'id' => '3',
            'name' => 'تگ ها',
            'class' => 'fas fa-fw fa-tag',
            'url' => url('panel/tags')
        ],
        [
            'id' => '4',
            'name' => 'برند ها',
            'class' => 'fas fa-fw fa-hashtag',
            'url' => url('panel/brands')
        ],
        [
            'id' => '5',
            'name' => 'محصولات',
            'class' => 'fas fa-fw fa-pump-soap',
            'url' => url('panel/products')
        ],
        [
            'id' => '6',
            'name' => 'بنرها',
            'class' => 'fas fa-laugh-wink',
            'url' => url('panel/banners')
        ],
        [
            'id' => '7',
            'name' => 'سطوح دسترسی',
            'class' => 'fas fa-fw fa-folder',
            'sub-menu' => [
                ['name' => 'نقش کاربری', 'url' => '/panel/roles'],
                ['name' => 'سطوح دسترسی', 'url' => '/panel/permissions'],
            ],
        ],
        [
            'id' => '8',
            'name' => 'کارمندان',
            'class' => 'fas fa-fw fa-folder',
            'sub-menu' => [
                ['name' => 'لیست کارمندان', 'url' => '/panel/coworkers'],
                ['name' => 'دپارتمان ها', 'url' => '/panel/coworkers/departments'],
            ],
        ],
        [
            'id' => '9',
            'name' => 'تیکت',
            'class' => 'fas fa-fw fa-folder',
            'url' => url('/panel/coworkers/tickets  ')
        ],
    ]
];
