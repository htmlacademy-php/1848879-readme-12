<?php

require_once('settings.php');

$is_auth = rand(0, 1);

$user_name = 'Владислав';

$cards = simpleRequest(
    'SELECT p.*, u.name, ct.class_name
            FROM posts p
                     JOIN users u ON p.user_id = u.id
                     JOIN type_posts ct ON p.type_id = ct.id
            ORDER BY views_amount DESC;'
        );

$types = simpleRequest('SELECT class_name FROM type_posts');

$page_content = include_template('main.php',
                                 [
                                     'cards' => $cards,
                                     'types' => $types
                                 ]);
$layout_content = include_template('layout.php',
                                   [
                                       'content' => $page_content,
                                       'title' => 'readme: популярное',
                                       'is_auth' => $is_auth,
                                       'user_name' => $user_name,
                                   ]);

print($layout_content);
