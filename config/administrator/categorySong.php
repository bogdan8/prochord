<?php
return [
    'title' => 'Категорії',
    'single' => 'категорію',
    'model' => 'App\Models\CategorySong',
    'columns' => [
        'id' => [
            'title' => 'Індифікатор',
        ],
        'active' => [
            'title' => 'Показувати чи ні',
        ],
        'title' => [
            'title' => 'Назва',
        ],
        'title_rus' => [
            'title' => 'Назва на rus',
        ],
        'title_eng' => [
            'title' => 'Назва на eng',
        ],
    ],
    'edit_fields' => [
        'active' => [
            'title' => 'Показувати',
            'type' => 'bool',
        ],
        'title' => [
            'title' => 'Назва',
            'type' => 'text',
        ],
        'title_rus' => [
            'title' => 'Назва на rus',
            'type' => 'text',
        ],
        'title_eng' => [
            'title' => 'Назва на eng',
            'type' => 'text',
        ],
        'image' => [
            'title' => 'Картинка',
            'type' => 'image',
            'location' => public_path() . '/uploads/category/',
            'sizes' => [
                [200, 200, 'auto', public_path() . '/uploads/category/', 200],
            ],
        ],
    ],
    'filters' => array(
        'active' => [
            'title' => 'Показувати',
        ],
        'title' => [
            'title' => 'Назва',
            'type' => 'text',
        ],
    ),
    'form_width' => 500,
];
