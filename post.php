<?php

require_once('settings.php');

// проверяет на заполненность запроса и что запрос числовой

if (!is_numeric($_GET['post_id']) || empty($_GET['post_id'])) {
    http_response_code(404);
    die('Такой страницы не существует!');
}

$post = getDataDb('SELECT * FROM posts WHERE id = ' . xssGetString($_GET['post_id']));

if (!$post) {
    http_response_code(404);
    die('Такой страницы не существует!');
}

// проверяет есть ли такой тип постов и выводит строку названия
$type_post = getTypePost($post[0]['type_id']);

$post_active = include_template('post-type/'. $type_post .'.php', ['post' => $post]);

$page_content = include_template('post-details.php', ['post_active' => $post_active, 'post' => $post]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'readme: популярное',
    'is_auth' => rand(0, 1),
    'user_name' => 'Владислав',
]);

print($layout_content);
