<?php

const HOST = 'localhost';
const USER = 'root';
const PASS = 'root';
const NAME = 'readme';

$con = mysqli_connect(HOST, USER, PASS,NAME);
mysqli_set_charset($con, "utf8");

$message = sprintf('Ошибка подключения: %s', mysqli_connect_error());

if ($con) {
    $message = 'Соединение установлено';
}

print($message);
