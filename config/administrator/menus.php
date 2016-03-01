<?php
return [
    'title' => 'Меню',
    'single' => 'пункт',
    'model' => 'App\Models\Menu',
    'columns' => [
        'weight'=>[
            'title'=>'Порядковий номер',
        ],
        'active'=>[
            'title'=>'Показувати чи ні',
        ],
        'title'=>[
            'title'=>'Назва',
        ],
        'title_rus' => [
            'title' => 'Назва на rus',
        ],
        'title_eng' => [
            'title' => 'Назва на eng',
        ],
        'position'=>[
            'title'=>'Позиція',
        ],
        'url'=>[
            'title'=>'Адреса',
        ],
    ],
    'edit_fields' => [
        'active' => [
            'title' => 'Показувати',
            'type' => 'bool',
        ],
        'weight' => [
            'title' => 'Порядковий №',
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
        'url' => [
            'title' => 'Адреса',
            'type' => 'text',
        ],
        'position' => [
            'title' => 'Позиція',
            'type' => 'enum',
            'options' => [
                'left',
                'right',
            ],
        ],
    ],
     'filters' => array(
        'active'=> array(
            'title' => 'Активне',
        ),
        'title' => array(
            'title' => 'Імя',        
        ),
    ),
];
