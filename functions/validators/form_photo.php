<?php

/**
 * Функция проверяет файл загруженный через форму обратной связи.
 * и если он соответствует критериям загружает его в папку uploads
 * @param array $files массив данных о файле
 *
 * @return string|null Ошибку если валидация не прошла
 */
function upload_post_picture(array $files): ?string
{
    if (($files['picture']['size'] >= 104857600)) {
        return 'прикрепленный файл слишком большой';
    }

    $valid_mime_types = ['image/png', 'image/jpeg', 'image/gif'];
    if (!in_array(mime_content_type($files['picture']['tmp_name']), $valid_mime_types)) {
        return 'Не подходящий формат прикрепленного изображения. Используйте jpg, png или gif.';
    }

    return null;
}

/**
 * Функция проверяет файл по ссылке. и если он соответствует критериям загружает его в папку uploads
 * @param string $url ссылка на сайт
 *
 * @return string Ошибку если валидация не прошла
 */
function validateFormPhotoUrl($photoUrl): ?string
{
    $safePost = getSafePost(trim($_POST[$photoUrl]));

    if (!empty($safePost)) {

        $filterUrl = filter_var($safePost, FILTER_VALIDATE_URL);

        if ($safePost) {

            $allowedPics = ['jpg', 'jpeg', 'png', 'gif'];

            $fileName = basename(parse_url($filterUrl, PHP_URL_PATH));
            $mime = pathinfo($fileName, PATHINFO_EXTENSION);

            if (!in_array($mime, $allowedPics)) {
                return 'Ссылка должна заказчиваться на .jpg, .jpeg, .png, .gif';
            }
        } else {
            return 'Необходимо указать корректную ссылку';
        }
    }

    return null;
}
