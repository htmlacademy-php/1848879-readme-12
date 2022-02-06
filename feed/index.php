<?php

require_once dirname(__DIR__) . '/settings.php';

$page_content = include_template('feed.php', [

]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'readme: популярное',
]);

print($layout_content);
