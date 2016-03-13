<?php
return [
    'title' => 'Уроки',
    'single' => 'урок',
    'model' => 'App\Models\Lessons',
    'columns' => [
        'id' => [
            'title' => 'Індифікатор',
        ],
        'number_lesson' => [
            'title' => 'Номер урока',
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
        'number_lesson' => [
            'title' => 'Номер урока',
            'type' => 'number',
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
        'body' => [
            'title' => 'Текст',
            'type' => 'wysiwyg',
        ],
        'body_rus' => [
            'title' => 'Текст на rus',
            'type' => 'wysiwyg',
        ],
        'body_eng' => [
            'title' => 'Текст на eng',
            'type' => 'wysiwyg',
        ],
        'date' => [
            'type' => 'datetime',
            'title' => 'Дата',
            'date_format' => 'yy-mm-dd',
            'time_format' => 'HH:mm',
        ],
    ],
    'filters' => array(
        'title' => [
            'title' => 'Назва',
            'type' => 'text',
        ],
    ),
    'form_width' => 500,
];
