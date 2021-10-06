<?php

/**
 * Функция принимает строку и если она больше
 * 300 символов то обрезает ее и добавляет ссылку
 * @param string $text принимает текст и дальше функция
 * проверяет соответствует ли она длинне
 * @param int $long допустимое кол-во символов, по умолчанию 300
 * @return string
 */
function cropping_text(string $text, int $long = 300): string
{

    if (strlen($text) > $long) {
        $arrays_symbols = explode(' ', $text);
        $count = 0;
        $sum = 0;
        $new_words = [];
        $format = '<p> %s...</p> <a class="post-text__more-link" href="#">Читать далее</a>';

        while ($sum < $long) {
            $sum += strlen($arrays_symbols[$count]);
            $new_words[] = $arrays_symbols[$count];
            $count++;
        }

        $total_text = implode(' ', $new_words);

        return sprintf($format, $total_text);
    }

    return sprintf('<p> %s </p>', $text);
}

/**
 * Функция принимает дату в формате ГГГГ-ММ-ДД ЧЧ:ММ
 * и высчитывает сколько прошло времени с публикации поста
 * @param string $time
 * @return string
 */
function time_has_passed(string $time): string
{
    date_default_timezone_set('Europe/Moscow');

    $time_post = strtotime($time);
    $time_now = strtotime(date("Y-m-d H:i:s"));

    define("MINUTE", 60);
    define("HOUR", MINUTE * 60);
    define("DAY", HOUR * 24);
    define("WEEK", DAY * 7);
    define("MONTH", DAY * 30);

    define("DAY_IN_MINUTES", 1440);
    define("HOUR_IN_MINUTE", 60);
    define("WEEK_IN_MINUTES", DAY_IN_MINUTES * 7);
    define("FIVE_WEEKS", WEEK_IN_MINUTES * 5);


    $time_difference = floor(($time_now - $time_post) / MINUTE);
    $time_total = '';

    if ($time_difference < HOUR_IN_MINUTE) {
        $time_total =
            $time_difference . ' ' .
            get_noun_plural_form($time_difference, 'минута', 'минуты', 'минут') .
            ' назад';
    }
    elseif ($time_difference >= HOUR_IN_MINUTE && $time_difference < DAY_IN_MINUTES) {
        $hours = floor(($time_now - $time_post) / HOUR);

        $time_total =
            $hours . ' ' .
            get_noun_plural_form($hours, 'час', 'часа', 'часов') .
            ' назад';
    } elseif ($time_difference >= DAY_IN_MINUTES && $time_difference < WEEK_IN_MINUTES) {
        $days = floor(($time_now - $time_post) / DAY);

        $time_total =
            $days . ' ' .
            get_noun_plural_form($days, 'день', 'дня', 'дней') .
            ' назад';
    } elseif ($time_difference >= WEEK_IN_MINUTES && $time_difference < FIVE_WEEKS) {
        $weeks = floor(($time_now - $time_post) / WEEK);

        $time_total =
            $weeks . ' ' .
            get_noun_plural_form($weeks, 'неделю', 'недели', 'недель') .
            ' назад';
    } elseif ($time_difference >= FIVE_WEEKS) {
        $months = floor(($time_now - $time_post) / MONTH);

        $time_total =
            $months . ' ' .
            get_noun_plural_form($months, 'месяц', 'месяца', 'месяцев') .
            ' назад';
    }

    return $time_total;

}

/**
 * Функция принимает дату в формате ГГГГ-ММ-ДД ЧЧ:ММ
 * и меняет формат на удобочитабельный для пользователя
 * формата ДД.ММ.ГГ ЧЧ.ММ
 * @param string $time
 * @return string
 */
function get_time_format(string $time): string
{
    $time_post = strtotime($time);

    return date("d.m.Y H:i", $time_post);
}

/**
 * Функция принимает гет запрос и защищает принимаемые данные
 * @param string $getString
 * @return string
 */
function xssGetString(string $getString): string
{
    $getString = trim($getString);
    $getString = stripslashes($getString);

    return htmlspecialchars($getString);
}

/**
 * Функция возвращает ошибку 404
 * @return string
 */
function getCode404(): string
{
    define("HTTP_NOT_FOUND", 404);

    http_response_code(HTTP_NOT_FOUND);
    die('Такой страницы не существует!');
}

/**
 * Принимает имя input и отдает название имя поля, где ошибка
 * @param string $name имя поля где ошибка
 * @return string
 */
function checkNameError(string $name): string
{
    $names = '';

    switch ($name) {
        case 'heading':
            $names = 'Заголовок.';
            break;
        case 'content':
            $names = 'Текст поста.';
            break;
        case 'quote-content':
            $names = 'Цитата.';
            break;
        case 'photo-url':
            $names = 'Ссылка из интернета.';
            break;
        case 'link':
            $names = 'Ссылка.';
            break;
        case 'quote-author':
            $names = 'Автор.';
            break;
        case 'tags':
            $names = 'Теги.';
            break;
    }

    return $names;
}
