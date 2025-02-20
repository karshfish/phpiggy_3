<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException as VE;
use App\Config\Paths;

class ReceiptService
{
    public function __construct(
        private Database $db,
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
    }
    public function upload(array $file, int $transactionId)
    {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFilename = bin2hex(random_bytes(20)) . "." . $extension;
        $uploadPath = Paths::STORAGE . "/" . $newFilename;
        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new VE(['receipt' => ['Failed to move uploaded file']]);
        }
        $this->db->query("INSERT INTO transaction_receipts (transaction_id, original_filename, storage_filename, media_type) VALUES
         (:transaction_id, :original_filename, :storage_filename, :media_type)", [
            'transaction_id' => $transactionId,
            'original_filename' => $file['name'],
            'storage_filename' => $newFilename,
            'media_type' => $file['type']
        ]);
    }
    public function getReceipt(string $receiptId): mixed
    {
        return $this->db->query("SELECT * FROM transaction_receipts WHERE id=:id", [
            'id' => $receiptId
        ])->find();
    }
    public function read(array $receipt)
    {
        $filePath = Paths::STORAGE . "/" . $receipt['storage_filename'];
        if (!file_exists($filePath)) {
            redirectTO('/');
        }
        header("Content-Type: {$receipt['media_type']}");
        header("Content-Disposition: inline; filename={$receipt['original_filename']}");
        readfile($filePath);
    }
    public function delete(array $receipt)
    {
        $filePath = Paths::STORAGE . "/" . $receipt['storage_filename'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $this->db->query("DELETE FROM transaction_receipts WHERE id=:id", [
            'id' => $receipt['id']
        ]);
    }
}
