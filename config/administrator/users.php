<?php
return [
    'title' => 'Користувачі',
    'single' => 'користувача',
    'model' => 'App\Models\User',
    'columns' => [
        'id' => [
            'title' => 'Індифікатор',
        ],
        'email' => [
            'title' => 'Емайл',
        ],
        'name' => [
            'title' => 'Імя',
        ],
    ],
    'edit_fields' => [
        'email' => [
            'title' => 'Email',
            'type' => 'text',
        ],
        'name' => [
            'title' => 'Імя',
            'type' => 'text',
        ],
    ],
    'filters' => array(
        'email' => [
            'title' => 'Email',
        ],
        'name' => [
            'title' => 'Імя',
            'type' => 'text',
        ],
    ),
    'form_width' => 400,
];
