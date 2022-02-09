<?php

function getAuthorizedUser()
{
    $authorized = false;

    if ($_SESSION && $_COOKIE['visit']) {
        $authorized = true;
    }

    return $authorized;
}
