<?php

declare(strict_types=1);

use Framework\TemplateEngine as TE;
use App\Config\Paths as PATH;
use App\Services\ValidatorService as VS;

return [
    TE::class => fn () => new TE(PATH::VIEW),
    VS::class => fn () => new VS
];
