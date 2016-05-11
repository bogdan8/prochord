<?php
return [
    'title' => 'Акорди',
    'single' => 'акорд',
    'model' => 'App\Models\ChordSong',
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
        'image' => [
            'title' => 'картинка',
            'type' => 'image',
            'location' => public_path() . '/uploads/chord/original/',

        ],
        'description' => [
            'title' => 'Опис',
            'type' => 'text',
        ],
        'description_rus' => [
            'title' => 'Опис на rus',
            'type' => 'text',
        ],
        'description_eng' => [
            'title' => 'Опис на eng',
            'type' => 'text',
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
