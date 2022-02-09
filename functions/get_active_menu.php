<?php

function getActiveMenu($type)
{
    $urls = str_split($_SERVER["REQUEST_URI"]);
    $str = '';

    foreach ($urls as $url) {
        if ($url == '?') {
            break;
        }

        $str .= $url;
    }

    return $str === $type;
}
