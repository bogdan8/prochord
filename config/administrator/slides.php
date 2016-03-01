<?php
return [
    'title' => 'Слайдер',
    'single' => 'слайд',
    'model' => 'App\Models\Slider',
    'columns' => [
        'id' => [
            'title' => 'Індифікатор',
        ],
        'active' => [
            'title' => 'Показувати чи ні',
        ],
        'image' => [
            'title' => 'Картинка',
            'output' => '<img src="/uploads/slides/small/(:value)"/>',
        ]
    ],
    'edit_fields' => [
        'active' => [
            'title' => 'Показувати',
            'type' => 'bool',
        ],
        'weight' => [
            'title' => 'Порядковий №',
            'type' => 'number',
        ],
        'image' => [
            'title' => 'Картинка',
            'type' => 'image',
            'location' => public_path() . '/uploads/slides/original/',
            'sizes' => [
                [100, 100, 'auto', public_path() . '/uploads/slides/small/', 100],
                [1000, 800, 'auto', public_path() . '/uploads/slides/large/', 100],
            ],
        ],

    ],
    'filters' => array(
        'active' => [
            'title' => 'Показувати',
        ],
        'weight' => [
            'title' => 'Порядковий номер',
            'type' => 'number',
        ],
    ),
    'form_width' => 500,
];
