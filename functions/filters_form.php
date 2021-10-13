<?php

require_once 'functions/validators/form_photo.php';
require_once 'validators/form_video.php';
require_once 'validators/form_link.php';
require_once 'validators/form_general.php';

/**
 * Проверка Заголовка и тега на ошибки
 * @param string $heading заголовок
 * @param string $tags тег
 * @return array Ошибки если валидация не прошла
 */
function checkTypeGeneral (string $heading, string $tags): array
{
    $errors = [];

    $headingLength = isCorrectFullness($heading);
    if ($headingLength) {
        $errors[$heading] = $headingLength;
    }

    if ($_POST[$tags] != '') {
        $tagsCorrectly = checkTags($tags);

        if ($tagsCorrectly) {
            $errors[$tags] = $tagsCorrectly;
        }
    }

    return $errors;
}

/**
 * Проверка картинки на ошибки
 * @param string $content картинка
 * @return array Ошибки если валидация не прошла
 */
function checkTypePhoto(string $content): array
{
    $errors = [];

    if ($_POST[$content] != '') {
        $contentUrl = validateFormPhotoUrl($content);

        if ($contentUrl) {
            $errors[$content] = $contentUrl;
        }
    }

    if (!empty($_FILES['picture']['name'])) {
        $files = $_FILES;
        $uploads = upload_post_picture($files);
        if (!empty($uploads)) {
            $errors[$content] = $uploads;
        }
    }

    if(empty($_FILES['picture']['name']) && empty($_POST[$content])) {
        $errors['picture'] = 'Загрузите картинку или добавьте ссылку из интернета';
    }

    return $errors;
}

/**
 * Проверка Видео на ошибки
 * @param string $content видео
 * @return array Ошибки если валидация не прошла
 */
function checkTypeVideo(string $content): array
{
    $errors = [];

    $checkYoutube = validateFormVideoUrl($_POST[$content]);

    if ($checkYoutube != '') {
        $errors[$content] = $checkYoutube;
    }

    return $errors;
}

/**
 * Проверка текста на ошибки
 * @param string $content Текст поста
 * @return array Ошибки если валидация не прошла
 */
function checkTypeText(string $content): array
{
    $errors = [];

    $contentLength = isCorrectFullness($content, 50, 1000);
    if ($contentLength) {
        $errors[$content] = $contentLength;
    }

    return $errors;
}

/**
 * Проверка Цитаты на ошибки
 * @param string $content Текст цитаты
 * @param string $author автор
 * @return array Ошибки если валидация не прошла
 */
function checkTypeQuote(string $content, string $author): array
{
    $errors = [];

    $contentLength = isCorrectFullness($content, 10, 1000);
    if ($contentLength) {
        $errors[$content] = $contentLength;
    }

    $authorLength = isCorrectFullness($author);
    if ($authorLength) {
        $errors[$author] = $authorLength;
    }

    return $errors;
}

/**
 * Проверка Ссылки на ошибки
 * @param string $content Ссылка
 * @return array Ошибки если валидация не прошла
 */
function checkTypeLink(string $content): array
{
    $errors = [];

    $contentUrl = checkUrl($content);

    if ($contentUrl != '') {
        $errors[$content] = $contentUrl;
    }

    return $errors;
}
