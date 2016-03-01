<?php
return [
    'title' => 'Виконавці',
    'single' => 'виконавця',
    'model' => 'App\Models\Performer',
    'columns' => [
        'id'=> [
            'title' => 'Індифікатор',
        ],
        'active'=> [
            'title' => 'Показувати чи ні',
        ],
        'title'=> [
            'title' => 'Назва',
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
        'birth' => [
            'type' => 'date',
            'title' => 'Дата народження(створення)',
            'date_format' => 'yy-mm-dd', //optional, will default to this value
        ],
        'place' => [
            'title' => 'Місто народження(створення)',
            'type' => 'text',
        ],
        'country' => [
            'title' => 'Країна',
            'type' => 'text',
        ],
        'description' => [
            'title' => 'Опис',
            'type' => 'wysiwyg',
        ],
        'image' => [
            'title' => 'Фото',
            'type' => 'image',
            'location' => public_path() . '/uploads/performer/',
            'sizes' => [
                [200, 200, 'auto', public_path() . '/uploads/performer/', 200],
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
