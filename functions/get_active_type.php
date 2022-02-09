<?php

function getActiveType($type, $card)
{
    return $type['class_name'] === $card[0]['class_name'];
}
