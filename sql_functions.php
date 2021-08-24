<?php

require_once 'config/connect.php';

/**
 * Функция принимает sql запрос и отдает готовый массив из бд
 * @param string $sql sql запрос
 * @return array
 */

function getDataDb(string $sql): array
{
    $con = mysqli_connect(HOST, USER, PASS, NAME);
    mysqli_set_charset($con, "utf8");

    $result = mysqli_query($con, $sql);

    if(!$result) {
        http_response_code(404);
        die('Такой страницы не существует!');
    }

    return  mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция принимает массив поста и отдает строку
 * @param string $post массив поста
 * @return string
 */

function getTypePost(string $post): string
{
    $type = '';

    switch ($post) {
        case '1':
            $type = 'photo';
            break;
        case '2':
            $type = 'video';
            break;
        case '3':
            $type = 'text';
            break;
        case '4':
            $type = 'quote';
            break;
        case '5':
            $type = 'link';
            break;
    }

    return $type;
}
