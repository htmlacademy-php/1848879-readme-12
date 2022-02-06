<?php

require_once('settings.php');

if ($_SESSION) {

    $sortingParameters = 'all';

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

        if (!empty($cards[0])) {
            $sortingParameters = $cards[0]['class_name'];
        }
    }

    $page_content = include_template('feed.php', [
        'types' => getDataDb('SELECT * FROM type_posts'),
        'sortingParameters' => $sortingParameters,
    ]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'title' => 'readme: популярное',
    ]);

    print($layout_content);
} else {
    $layout_content = include_template('main_layout.php', [
        'title' => 'readme: популярное',
    ]);

    print($layout_content);
}
