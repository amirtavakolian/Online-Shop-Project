<?php

return [
    'items' => [
        [
            'name' => 'دسته بندی ها',
            'class' => 'fas fa-fw fa-folder',
            'url' => url('panel/category')
        ],
        [
            'name' => 'ویژگی ها',
            'class' => 'fas fa-fw fa-table',
            'url' => url('panel/attributes')
        ],
        [
            'name' => 'تگ ها',
            'class' => 'fas fa-fw fa-tag',
            'url' => url('panel/tags')
        ],
        [
            'name' => 'برند ها',
            'class' => 'fas fa-fw fa-hashtag',
            'url' => url('panel/brands')
        ],
        [
            'name' => 'محصولات',
            'class' => 'fas fa-fw fa-pump-soap',
            'url' => url('panel/products')
        ]
    ]
];
