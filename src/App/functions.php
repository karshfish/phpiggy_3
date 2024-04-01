<?php
/*the only purpose of this function is to out the array in a pre format
and then stop the script*/

declare(strict_types=1);
function dd(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
function e(mixed $value): string    //sugar function for escapng the dangerous charachters 
{
    return htmlspecialchars((string) $value);
}
