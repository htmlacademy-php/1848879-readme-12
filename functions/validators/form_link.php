<?php

/**
 * Функция проверяет ссылку
 * @param string $url ссылка
 *
 * @return string Ошибка валидации если она есть
 */
function checkUrl(string $url): string
{
    $safePost = getSafePost(trim($_POST[$url]));

    if (empty($safePost)) {
        return 'Поле не заполнено';
    }

    if (!filter_var($safePost, FILTER_VALIDATE_URL)) {
        return "Формат ссылки не верен.";
    }

    return '';
}
