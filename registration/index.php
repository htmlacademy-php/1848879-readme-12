<?php

require_once( dirname(__DIR__) . '/settings.php');

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileUrl = null;
    $validate = checkRegister($_POST);

    $errors = $validate;

    if(empty(array_filter($errors))){
        if(!empty($_FILES['picture']['name'])) {
            $fileUrl = uploadImage($_FILES, 'picture');
        }

        $postId = addUser($_POST, $fileUrl);
    }
}

$page_content = include_template('registration.php', [
    'errors' => $errors,
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'readme: Регистрация',
]);

print($layout_content);
