<?php
return [
    'title' => 'Молодь і влада',
    'edit_fields' => [
        'title' => [
            'title' => 'Назва',
            'type' => 'text',
        ],
        'title_eng' => [
            'title' => 'Назва на eng',
            'type' => 'text',
        ],
        'content' => [
            'title' => 'Текст',
            'type' => 'wysiwyg',
        ],
        'content_eng' => [
            'title' => 'Текст на eng',
            'type' => 'wysiwyg',
        ],
        'image' => [
            'title' => 'Картинка 1',
            'type' => 'image',
            'location' => public_path() . '/uploads/molodb/1/',
        ],
        'imagee' => [
            'title' => 'Картинка 2',
            'type' => 'image',
            'location' => public_path() . '/uploads/molodb/2/',
        ],
        'imageee' => [
            'title' => 'Картинка 3',
            'type' => 'image',
            'location' => public_path() . '/uploads/molodb/3/',
        ],

    ],
];