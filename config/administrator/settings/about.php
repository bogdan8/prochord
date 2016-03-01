<?php
return [
    'title' => 'Про нас',
    'edit_fields' => [
        'content' => [
            'title' => 'Текст',
            'type' => 'wysiwyg',
        ],
        'image' => [
            'title' => 'Картинка',
            'type' => 'image',
            'location' => public_path() . '/uploads/',
        ],
    ],
];