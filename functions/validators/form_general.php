<?php

/**
 * Проверка длинны
 * @param string $name
 * * @param int $min
 * * @param int $max
 * @return string|null
 */
function isCorrectFullness(string $name, int $min = 3, int $max = 40): ?string
{
    $safePost = getSafePost(trim($_POST[$name]));

    if (empty($safePost)) {
        return 'Поле не заполнено';
    }

    $len = strlen($safePost);

    if ($len < $min || $len > $max) {
        return "Значение должно быть от $min до $max символов";
    }

    return false;
}

/**
 * Функция проверяет поле теги на соответствие тз
 * @param string $tags Строчка тегов
 *
 * @return string Ошибку если валидация не прошла
 */
function checkTags(string $tags): string
{
    $safePost = getSafePost(trim($_POST[$tags]));

    if (!empty($safePost)) {
        $len = strlen($safePost);

        if ($len < 2 or $len > 250) {
            return "Значение должно быть от 2 до 250 символов";
        }

        $hashtags = explode(' ', $safePost);

        foreach ($hashtags as $hashtag) {
            if (substr($hashtag, 0, 1) !== '#') {
                return 'Хэштег должен начинаться со знака решетки';
            }
            if (strrpos($hashtag, '#') > 0) {
                return 'Хэш-теги разделяются пробелами';
            }
            if (strlen($hashtag) < 2) {
                return 'Хэш-тег не может состоять только из знака решетки';
            }
        }
    }
    return false;
}
