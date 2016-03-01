<?php
return [
    'title' => 'Алфавіт',
    'single' => 'букву',
    'model' => 'App\Models\Alphabet',
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
