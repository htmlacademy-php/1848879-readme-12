<?php

require_once 'config/connect.php';

/**
 * Функция принимает sql запрос и отдает готовый массив из бд
 * @param string $sql Sql запрос
 * @return array
 */

function getDataDb(string $sql): array
{
    $con = mysqli_connect(HOST, USER, PASS, NAME);
    mysqli_set_charset($con, "utf8");

    $result = mysqli_query($con, $sql);

    if(!$result) {
        print(sprintf('Ошибка подключения: %s', mysqli_connect_error()));
    }

    return  mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция принимает sql запрос с гет параметром и отдает готовый массив из бд
 * @param string $sql Sql запрос
 * @return array
 */

function takesGetDataDb(string $sql): array
{
    $con = mysqli_connect(HOST, USER, PASS, NAME);
    mysqli_set_charset($con, "utf8");

    $result_query = mysqli_query($con, $sql);

    if(!$result_query) {
        print(sprintf('Ошибка подключения: %s', mysqli_connect_error()));
    }

    $result = mysqli_fetch_all($result_query, MYSQLI_ASSOC);

    if (!$result) {
        getCode404();
    }

    return  $result;
}

/**
 * Функция принимает тип поста и отдает строку названия типа
 * @param int $type_id Id типа
 * @return string
 */

function getTypeID(int $type_id): string
{
    $postTypes = ['empty', 'photo', 'video', 'text' , 'quote', 'link'];

    return $postTypes[$type_id];
}

/**
 * Функция принимает пост запрос и делает его безопасным
 * @param string $inquiry Пост запрос
 * @return string
 */

function getSafePost(string $inquiry): string
{
    $con = mysqli_connect(HOST, USER, PASS, NAME);

    return mysqli_real_escape_string($con, $inquiry);
}
