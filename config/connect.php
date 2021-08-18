<?php

const HOST = 'localhost';
const USER = 'root';
const PASS = 'root';
const NAME = 'readme';

$con = mysqli_connect(HOST, USER, PASS,NAME);
mysqli_set_charset($con, "utf8");

if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
    print("Соединение установлено");
}
