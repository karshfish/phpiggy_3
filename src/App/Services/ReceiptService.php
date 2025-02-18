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
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new VE(['receipt' => ['failed to upload the file']]);
        }
        $maxFileSize = 3 * 1024 * 1024;
        if ($file['size'] > $maxFileSize) {
            throw new VE(['receipt' => ['File is too large']]);
        }
        $originalFileName = $file['name'];
        if (!preg_match('/^[A-za-z0-9\s._-]+$/', $originalFileName)) {
            throw new VE(['receipt' => ['Wrong file name']]);
        }
        $fileMimeType = $file['type'];
        $allowedMimeTypes = ['image/png', 'image/jpeg', 'application/pdf'];
        if (!in_array($fileMimeType, $allowedMimeTypes)) {
            throw new VE(['receipt' => ['Wrong file type']]);
        }
        dd($file);
    }
}
