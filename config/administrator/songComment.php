<?php
return [
    'title' => 'Коментарі до пісень',
    'single' => 'Додати коментарій',
    'model' => 'App\Models\SongComment',
    'columns' => [
        'id'=>[
            'title'=>'Індиф.',
        ],
        'song_id'=>[
            'title'=>'Номер пісні',
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
        'date'=>[
            'title'=>'Дата',
        ],
    ],
    'edit_fields' => [
        'song' => [
            'title' => 'Назва пісні',
            'type' => 'relationship',
            'name_field' => 'title',
        ],
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
        'song'=> array(
            'title' => 'Назва пісні',
            'type' => 'relationship',
            'name_field' => 'title',
        ),
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
