<?php

declare(strict_types=1);

use Framework\TemplateEngine as TE;
use App\Config\Paths as PATH;
use App\Services\ValidatorService as VS;
use Framework\Database as DB;

return [
    TE::class => fn () => new TE(PATH::VIEW),
    VS::class => fn () => new VS,
    DB::class => fn () => new DB(
        $_ENV['DB_DRIVER'],
        [
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_NAME']
        ],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
    )
];
