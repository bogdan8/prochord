<?php
return [
    'title' => 'Пісні',
    'single' => 'пісню',
    'model' => 'App\Models\Song',
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
    ],
    'edit_fields' => [
        'active' => [
            'type' => 'bool',
            'title' => 'Показувати',
        ],
        'title' => [
            'type' => 'text',
            'title' => 'Назва',
        ],
        'slug' => [
            'type' => 'text',
            'title' => 'Назва для силки',
        ],
        'performer' => [
            'type' => 'relationship',
            'title' => 'Виконавець',
            'name_field' => 'title', //using the getFullNameAttribute accessor
        ],
        'description' => [
            'type' => 'text',
            'title' => 'Музика та слова',
        ],
        'categorySong' => [
            'type' => 'relationship',
            'title' => 'Категорія',
            'name_field' => 'title', //using the getFullNameAttribute accessor
        ],
        'tabulature' => [
            'type' => 'wysiwyg',
            'title' => 'Як грати',
        ],
        'body' => [
            'type' => 'wysiwyg',
            'title' => 'Текст',
        ],
        'note' => [
            'type' => 'wysiwyg',
            'title' => 'Ноти',
        ],
        'video' => [
            'type' => 'wysiwyg',
            'title' => 'Відео',
        ],
        'image' => [
            'title' => 'Картинка',
            'type' => 'image',
            'location' => public_path() . '/uploads/song/',
            'sizes' => [
                [200, 200, 'auto', public_path() .  '/uploads/song/', 200],
            ],
        ],
        'media_document' => [
            'title' => 'Файли',
            'type' => 'file',
            'location' => public_path() . '/uploads/media_documents/',
            'naming' => 'random',
            'length' => 20,
            'size_limit' => 500,
            'mimes' => 'zip,txt,pdf,psd,doc',
        ],
    ],
    'filters' => array(
        'active' => array(
            'title' => 'Активне',
        ),
        'title' => array(
            'title' => 'Імя',
        ),
    ),
    'form_width' => 800,
];
