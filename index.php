<?php

require_once('settings.php');

$is_auth = rand(0, 1);

$user_name = 'Владислав';

$cards = [
    [
        'id' => 0,
        'user_id' => 0,
        'title' => 'Цитата',
        'type' => 'post-quote',
        'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
        'name' => 'Лариса',
        'img' => 'userpic-larisa-small.jpg',
        'time' => '2021-07-19 13:05',

    ],
    [
        'id' => 1,
        'user_id' => 1,
        'title' => 'Игра престолов',
        'type' => 'post-text',
        'content' => 'Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!',
        'name' => 'Владик',
        'img' => 'userpic.jpg',
        'time' => '2021-07-19 12:05',
    ],
    [
        'id' => 2,
        'user_id' => 1,
        'title' => 'Наконец, обработал фотки!',
        'type' => 'post-photo',
        'content' => 'rock-medium.jpg',
        'name' => 'Виктор',
        'img' => 'userpic-mark.jpg',
        'time' => '2021-07-05 13:05',
    ],
    [
        'id' => 3,
        'user_id' => 2,
        'title' => 'Моя мечта',
        'type' => 'post-photo',
        'content' => 'coast-medium.jpg',
        'name' => 'Лариса',
        'img' => 'userpic-larisa-small.jpg',
        'time' => '2021-04-19 13:05',
    ],
    [
        'id' => 4,
        'user_id' => 1,
        'title' => 'Лучшие курсы',
        'type' => 'post-link',
        'content' => 'www.htmlacademy.ru',
        'name' => 'Владик',
        'img' => 'userpic.jpg',
        'time' => '2021-07-15 13:05',
    ],
];

$page_content = include_template('main.php', ['cards' => $cards]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => 'readme: популярное', 'is_auth' => $is_auth, 'user_name' => $user_name]);

print($layout_content);
