<?php
return [
    'title' => "Зв'язок",
    'single' => 'відповідь',
    'model' => 'App\Models\Feedback',
    'columns' => [
        'id' => [
            'title' => 'Індифікатор',
        ],
        'role' => [
            'title' => 'Адміністратор?',
        ],
        'name' => [
            'title' => 'Назва',
        ],
        'email' => [
            'title' => 'Емайл',
        ],
        'body' => [
            'title' => 'Текс',
        ],
    ],
    'edit_fields' => [
        'role' => [
            'title' => 'Адміністратор?',
            'type' => 'bool',
        ],
        'name' => [
            'title' => 'Назва',
            'type' => 'text',
        ],
        'email' => [
            'title' => 'Емайл',
            'type' => 'text',
        ],
        'body' => [
            'title' => 'Текс',
            'type' => 'textarea',
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
