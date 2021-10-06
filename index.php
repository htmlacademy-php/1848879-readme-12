<?php

require_once('settings.php');

// Для вывода
$sortingParameters = 'all';

$types = getDataDb('SELECT * FROM type_posts');

$users = getDataDb('SELECT * FROM users');

// Вывод постов по популярности
$cards = getDataDb(
    'SELECT p.*, u.name, ct.class_name
            FROM posts p
                     JOIN users u ON p.user_id = u.id
                     JOIN type_posts ct ON p.type_id = ct.id
            ORDER BY views_amount DESC;'
);

// проверяет нажата ли кнопка типов
if (!empty($_GET['type_post'])) {
    $type_post = xssGetString($_GET['type_post']);

// Вывод постов по популярности и типу поста
    $cards = getDataDb(
        sprintf(
            'SELECT p.*, u.name, ct.class_name
                FROM posts p
                    JOIN users u ON p.user_id = u.id
                    JOIN type_posts ct ON p.type_id = ct.id
                WHERE type_id = %s
                ORDER BY views_amount DESC ',
            $type_post
        )
    );

    $sortingParameters = reset($cards)['class_name'];
}

$page_content = include_template('main.php', [
    'cards' => $cards,
    'types' => $types,
    'users' => $users,
    'sortingParameters' => $sortingParameters,
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'readme: популярное',
    'is_auth' => rand(0, 1),
    'user_name' => 'Владислав',
]);

print($layout_content);

