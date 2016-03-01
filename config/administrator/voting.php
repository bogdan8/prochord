<?php
return [
    'title' => 'Назва голосування',
    'single' => 'голосування',
    'model' => 'App\Models\Voting',
    'columns' => [
        'active'=>[
            'title'=>'Показувати чи ні',
        ],
        'show_list'=>[
            'title'=>'Активне чи ні',
        ],
        'title'=>[
            'title'=>'Назва',
        ],
        'title_rus'=>[
            'title'=>'Назва на rus',
        ],
        'title_eng' => [
            'title' => 'Назва на eng',
        ],
    ],
    'edit_fields' => [
        'active'=>[
            'title'=>'Показувати чи ні',
            'type' => 'bool',
        ],
        'show_list'=>[
            'title'=>'Активне чи ні',
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
