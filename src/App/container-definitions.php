<?php

declare(strict_types=1);

use Framework\TemplateEngine as TE;
use App\Config\Paths as PATH;

return [
    TE::class => fn () => new TE(PATH::VIEW)
];
