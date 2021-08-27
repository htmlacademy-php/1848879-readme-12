<?php

const HOST = 'localhost';
const USER = 'root';
const PASS = 'root';
const NAME = 'readme';

$con = mysqli_connect(HOST, USER, PASS,NAME);
mysqli_set_charset($con, "utf8");

if (!$con) {
    print(sprintf('Ошибка подключения: %s', mysqli_connect_error()));
}
