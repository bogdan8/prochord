<?php
return [
    'title' => 'Список',
    'single' => 'список',
    'model' => 'App\Models\VotingList',
    'columns' => [
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
        'count' => [
            'title' => 'Кількість',
        ],
    ],
    'edit_fields' => [
        'voting' => [
            'title' => 'Голосування',
            'type' => 'relationship',
            'name_field' => 'title',
        ],
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
];
