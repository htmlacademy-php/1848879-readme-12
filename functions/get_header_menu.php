<?php

function getMenuHeader()
{
    $menu = [
        'popular' => [
            'title' => 'Популярный контент',
            'link' => '/popular/',
        ],
        'feed' => [
            'title' => 'Моя лента',
            'link' => '/',
        ],
        'messages' => [
            'title' => 'Личные сообщения',
            'link' => '#',
        ],
    ];

    return $menu;
}
