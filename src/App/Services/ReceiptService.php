<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException as VE;

class ReceiptService
{
    public function __construct(
        private Database $db
    ) {}
    public function validateFile(?array $file)
    {
        dd($file);
    }
}
