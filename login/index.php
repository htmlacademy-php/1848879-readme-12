<?php

require_once dirname(__DIR__) . '/settings.php';

$errors = [];
$authorized = false;

if ($_POST) {

    $errors = searchErrorsLogin();

}

$page_content = include_template('login.php', [
    'errors' => $errors,
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'readme: Авторизация',
]);

print($layout_content);
