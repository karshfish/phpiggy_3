<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException as VE;

class TransactionService
{
    public function __construct(
        private Database $db
    ) {}
    public function create(array $formData)
    {
        $formatDate = "{$formData['date']} 00:00:00";
        $this->db->query("INSERT INTO transactions (user_id, description, amount, date)
        VALUES(:user_id, :description, :amount, :date)", [
            'user_id' => $_SESSION['user'],
            'description' => $formData['description'],
            'amount' => $formData['amount'],
            'date' => $formatDate
        ]);
    }
}
