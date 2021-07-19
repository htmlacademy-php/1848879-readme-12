<?php

function cropping_text($text, $long = 300): string
{

    if (strlen($text) > $long) {
        $arrays_symbols = explode(' ', $text);
        $count = 0;
        $sum = 0;
        $new_words = [];

        while ($sum < $long) {
            $sum += strlen($arrays_symbols[$count]);
            $new_words[] = $arrays_symbols[$count];
            $count++;
        }

        return '<p>' . implode(' ', $new_words) . '...</p>' . '<a class="post-text__more-link" href="#">Читать далее</a>';
    }

    return $text;
}

function time_has_passed($time): string
{
    date_default_timezone_set('Europe/Moscow');

    $time_post = strtotime($time);
    $time_now = strtotime(date("Y-m-d H:i:s"));

    $time_difference = floor(($time_now - $time_post) / 60);

    if ($time_difference < 60) {
        return $time_difference . ' ' . get_noun_plural_form($time_difference, 'минута', 'минуты', 'минут') . ' назад';
    } elseif ($time_difference >= 60 && $time_difference < 1440) {
        $hours = floor(($time_now - $time_post) / 3600);

        return $hours . ' ' . get_noun_plural_form($hours, 'час', 'часа', 'часов') . ' назад';
    } elseif ($time_difference >= 1440 && $time_difference < 10080) {
        $days = floor(($time_now - $time_post) / 86400);

        return $days . ' ' . get_noun_plural_form($days, 'день', 'дня', 'дней') . ' назад';
    } elseif ($time_difference >= 10080 && $time_difference < 50400) {
        $weeks = floor(($time_now - $time_post) / 604800);

        return $weeks . ' ' . get_noun_plural_form($weeks, 'неделю', 'недели', 'недель') . ' назад';
    } elseif ($time_difference >= 50400) {
        $months = floor(($time_now - $time_post) / 2592000);

        return $months . ' ' . get_noun_plural_form($months, 'месяц', 'месяца', 'месяцев') . ' назад';
    }

    return '';

}

function get_time_format($time){
    $time_post = strtotime($time);

    return date("d.m.Y H:i", $time_post);
}
