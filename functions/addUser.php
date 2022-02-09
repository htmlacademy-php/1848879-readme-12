<?php

/**
 * Добавляет пользователя
 * @param array $dataPost метод POST
 * @param $fileUrl, если есть картинка
 */

function addUser(array $dataPost, $fileUrl = null)
{
    $con = mysqli_connect(HOST, USER, PASS, NAME);

    $email = getSafePost($dataPost['email']);
    $login = getSafePost($dataPost['login']);
    $pass = password_hash(getSafePost($dataPost['password']), PASSWORD_BCRYPT);
    $img = '/uploads/userpic.jpg';

    if(!empty($_FILES['picture']['name'])){
        if ($fileUrl) {
            $img = $fileUrl;
        }
    }

    $sql = "INSERT INTO `users` (email, name, password, avatar_url) VALUES ( '$email', '$login', '$pass', '$img')";

    if (mysqli_query($con, $sql)) {
        header("Location: /login/");
    } else {
        var_dump("Ошибка: " . mysqli_error($con));
    }

    return mysqli_insert_id($con);
}
