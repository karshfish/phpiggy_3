<?php
$driver = 'mysql';
$config = http_build_query($data = [
    'host' => 'localhost',
    'port' => 3306,
    'name' => 'phpiggy'
], arg_separator: ";");
$dsn = "{$driver}:{$config}";
echo $dsn;
