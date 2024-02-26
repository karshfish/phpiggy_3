<?php
declare (strict_types=1);
function dd(mixed $value)
{
    ECHO "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}