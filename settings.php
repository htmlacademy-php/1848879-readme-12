<?php

/**
 * Вспомогательные функций от академии
 */
require_once('functions/helpers.php');

/**
 * Функций для различных упрощений
 */
require_once('functions/functions.php');

/**
 * Скл функции, от туда идет запрос подключения к бд
 * в папке config/connect.php хранится информация к доступу к бд
 */
require_once('functions/sql_functions.php');

/**
 * Проверка формы
 */
require_once('functions/filters_form.php');

/**
 * Добавление формы
 */
require_once('functions/add_post.php');

/**
 * Проверка Регистрации
 */
require_once('functions/validators/registration.php');

/**
 * Добавление пользователя
 */
require_once('functions/addUser.php');

/**
 * Проверка Авторизации
 */
require_once('functions/validators/login.php');

/**
 * Проверка Авторизирован пользователь
 */
require_once('functions/get_authorized_user.php');

/**
 * Проверка какой тип
 */
require_once('functions/get_active_type.php');

session_start();
