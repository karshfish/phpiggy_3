<?php
/*the only purpose of this function is to out the array in a pre format*/
declare (strict_types=1);
function dd(mixed $value)
{
    ECHO "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}       