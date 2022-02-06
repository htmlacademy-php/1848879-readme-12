<?php

require_once dirname(__DIR__) . '/settings.php';

$errors = [];
$authorized = false;

if ($_POST) {

    $searchEmpty = getEmpty(['email', 'password']);

    if (empty($searchEmpty)) {

        $user = searchEmail(getSafePost($_POST['email']));

        if (!$user) {
            $errors['email'] = 'email не найден';
        }

        if ($user && password_verify(getSafePost($_POST['password']), $user['password'])) {
            $authorized = true;

        } else {
            $errors['password'] = 'пароль введен не правильно';
        }
    } else {
        $errors = $searchEmpty;
    }

    if (empty($errors) && $authorized) {
        session_start();

        setcookie('visit', $user['email'], time() + (60 * 60 * 24 * 30), '/');

        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        header('Location:/');
    }

}

$page_content = include_template('login.php', [
    'errors' => $errors,
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'readme: Авторизация',
]);

print($layout_content);
