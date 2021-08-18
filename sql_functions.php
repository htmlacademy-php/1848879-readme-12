<?php

require_once 'config/connect.php';

/**
 * Функция принимает sql запрос и отдает готовый массив из бд
 * @param string $sql sql запрос
 * @return array
 */

function simpleRequest(string $sql): array
{
    $con = mysqli_connect(HOST, USER, PASS,NAME);
    mysqli_set_charset($con, "utf8");

    $result = mysqli_query($con, $sql);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
