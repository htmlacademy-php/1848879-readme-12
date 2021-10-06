<?php

/**
 * Проверяет валидность введенной ссылки
 * @param $videoUrl - ссылка на видео из массива $_POST
 * @return string|null
 */
function validateFormVideoUrl($videoUrl): ?string
{
    if (!empty($videoUrl)) {

        $filterUrl = filter_var($videoUrl, FILTER_VALIDATE_URL);

        if ($filterUrl) {

            if (check_youtube_url($filterUrl) != true) {
                return check_youtube_url($filterUrl);
            }

        } else {
            return 'Ссылка на youtube должна быть корректной';
        }

    } else {
        return 'Ссылка на видео должна быть заполнена!';
    }

    return '';
}
