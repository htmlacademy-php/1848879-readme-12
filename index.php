<?php

require('helpers.php');

$is_auth = rand(0, 1);

$user_name = 'Владислав'; // укажите здесь ваше имя

$cards = [
    [
        'id' => 0,
        'user_id' => 0,
        'title' => 'Цитата',
        'type' => 'post-quote',
        'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
        'name' => 'Лариса',
        'img' => 'userpic-larisa-small.jpg',

    ],
    [
        'id' => 1,
        'user_id' => 1,
        'title' => 'Игра престолов',
        'type' => 'post-text',
        'content' => 'Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!Не могу дождаться начала финального сезона своего любимого сериала!',
        'name' => 'Владик',
        'img' => 'userpic.jpg',

    ],
    [
        'id' => 2,
        'user_id' => 1,
        'title' => 'Наконец, обработал фотки!',
        'type' => 'post-photo',
        'content' => 'rock-medium.jpg',
        'name' => 'Виктор',
        'img' => 'userpic-mark.jpg',

    ],
    [
        'id' => 3,
        'user_id' => 2,
        'title' => 'Моя мечта',
        'type' => 'post-photo',
        'content' => 'coast-medium.jpg',
        'name' => 'Лариса',
        'img' => 'userpic-larisa-small.jpg',

    ],
    [
        'id' => 4,
        'user_id' => 1,
        'title' => 'Лучшие курсы',
        'type' => 'post-link',
        'content' => 'www.htmlacademy.ru',
        'name' => 'Владик',
        'img' => 'userpic.jpg',

    ],
];

function cropping_text($text, $long=300){

    if(strlen($text) > $long) {
        $arrays_symbols = explode(' ', $text);
        $count = 0;
        $sum = 0;
        $new_words = [];

        while($sum < $long){
            $sum += strlen($arrays_symbols[$count]);
            $new_words[] = $arrays_symbols[$count];
            $count++;
        }

        return '<p>' .  implode(' ', $new_words) . '...</p>' . '<a class="post-text__more-link" href="#">Читать далее</a>';
    }

    return $text;
}


$page_content = include_template('main.php', ['cards' => $cards]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => 'readme: популярное', 'is_auth' => $is_auth, 'user_name' => $user_name]);

print($layout_content);
