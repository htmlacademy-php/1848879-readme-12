<?php

require_once('settings.php');

// проверяет на заполненность запроса и что запрос числовой

if (!is_numeric($_GET['post_id']) || empty($_GET['post_id'])) {
    getCode404();
}

$tags = getDataDb(sprintf('SELECT * FROM hashtags WHERE post_id = %s', xssGetString($_GET['post_id'])));

$users = getDataDb('SELECT * FROM users');

$post = takesGetDataDb(sprintf('SELECT * FROM posts WHERE id = %s', xssGetString($_GET['post_id'])));

// проверяет есть ли такой тип постов и выводит строку названия
$type_post = getTypeID(reset($post)['type_id']);

$post_active = include_template('post-type/' . $type_post . '.php', [
    'post' => reset($post),
]);

$page_content = include_template('post-details.php', [
    'post_active' => $post_active,
    'post' => reset($post),
    'tags' => $tags,
    'users' => $users,
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'readme: популярное',
]);

print($layout_content);
