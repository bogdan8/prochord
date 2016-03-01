<?php
return [
    'title' => 'Коментарі на головній сторіні',
    'single' => 'Додати коментарій',
    'model' => 'App\Models\IndexComment',
    'columns' => [
        'id'=>[
            'title'=>'Індиф.',
        ],
        'name'=>[
            'title'=>'Імя',
        ],
        'email'=>[
            'title'=>'Емайл',
        ],
        'body'=>[
            'title'=>'Текст',
        ],
    ],
    'edit_fields' => [
        'name' => [
            'type' => 'text',
            'title' => 'Імя',
        ],
        'email' => [
            'type' => 'text',
            'title' => 'Емайл',
        ],
        'date' => [
            'type' => 'datetime',
            'title' => 'Дата',
            'date_format' => 'yy-mm-dd', //optional, will default to this value
            'time_format' => 'HH:mm',    //optional, will default to this value
        ],
        'body' => [
            'type' => 'textarea',
            'title' => 'Текст',
        ],

    ],
     'filters' => array(
        'date' => array(
            'type' => 'datetime',
            'title' => 'Дата',
            'date_format' => 'yy-mm-dd', //optional, will default to this value
            'time_format' => 'HH:mm',    //optional, will default to this value
        ),
        'name' => [
            'type' => 'text',
            'title' => 'Імя',
        ],
        'email' => [
            'type' => 'text',
            'title' => 'Емайл',
        ],
    ),
    'form_width' => 500,
];
