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
 * Функция проверяет поле тэги на соответсвтие тз
 * @param string $tags строчка тегов
 *
 * @return string Ошибку если валидация не прошла
 */
function checkTags(string $tags): string
{
    $safePost = getSafePost(trim($_POST[$tags]));

    $tags_array = explode(" ", $safePost);
    if (preg_match('/[^a-zа-я ]+/msiu', $safePost)) {
        return 'Это поле должно состоять только из букв.';
    }
    foreach ($tags_array as $tag) {
        if (mb_strlen($tag) > 20) {
            return "Используется слишком длинный тег: {$safePost}.
            Подберите синоним или убедитесь что тег состоит из одного слова";
        }
    }
    return false;
}
