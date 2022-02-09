<?php

require_once('settings.php');

if (getAuthorizedUser()) {

    $sortingParameters = 'all';

    $cards = getDataDb(
        'SELECT p.*, u.name, ct.class_name
            FROM posts p
                     JOIN users u ON p.user_id = u.id
                     JOIN subscriptions s ON u.id = s.follower_id
                     JOIN type_posts ct ON p.type_id = ct.id
            ORDER BY views_amount DESC;'
    );

    $id = 6;

    $user = getDataDb(sprintf('SELECT * FROM users WHERE id=%s', $id));

    if (!empty($_GET['type_post'])) {
        $type_post = xssGetString($_GET['type_post']);

        $cards = getDataDb(
            sprintf(
                'SELECT p.*, u.name, ct.class_name
                FROM posts p
                    JOIN users u ON p.user_id = u.id
                    JOIN subscriptions s ON u.id = s.follower_id
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
        'cards' => $cards,
        'user' => $user,
    ]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'title' => 'readme: популярное',
    ]);

} else {
    $errors = [];

    if($_POST) {
        $errors = searchErrorsLogin();
    }

    $layout_content = include_template('main_layout.php', [
        'title' => 'readme: популярное',
        'errors' => $errors,
    ]);

}
print($layout_content);
