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
    public function findTransactions(int $length, int $offset): array
    {

        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $params = [
            'user_id' => $_SESSION['user'],
            'description' => "%{$searchTerm}%",

        ];
        $transactions = $this->db->query(
            "SELECT *, DATE_FORMAT(date,'%Y-%M-%D')as formatted_date FROM transactions
            WHERE user_id= :user_id
            AND description LIKE :description
            LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();
        $transactions = array_map(function ($transaction) {
            $transaction['receipts'] = $this->db->query("SELECT * FROM transaction_receipts WHERE transaction_id=:transaction_id", [
                'transaction_id' => $transaction['id']
            ])->findAll();
            return $transaction;
        }, $transactions);
        $transactionsCount = $this->db->query(
            "SELECT Count(*) FROM transactions
            WHERE user_id= :user_id
            AND description LIKE :description
            ",
            $params
        )->count();
        return [$transactions, $transactionsCount];
    }
    public function getUserTransaction(string $id): mixed
    {
        return $this->db->query("SELECT *, DATE_FORMAT(date,'%Y-%m-%d') as formatted_date FROM transactions
         WHERE user_id=:user_id AND
         id=:id ", [
            'user_id' => $_SESSION['user'],
            'id' => $id
        ])->find();
    }
    public function editTransaction(array $formData, string $id)
    {
        $formatDate = "{$formData['date']} 00:00:00";
        $this->db->query("UPDATE transactions SET description = :description, amount = :amount, date= :date
        WHERE user_id=:user_id AND id=:id", [
            'user_id' => $_SESSION['user'],
            'description' => $formData['description'],
            'amount' => $formData['amount'],
            'date' => $formatDate,
            'id' => $id
        ]);
    }
    public function delete(int $id)
    {
        $this->db->query("DELETE FROM transactions WHERE user_id=:user_id AND id=:id", [
            'user_id' => $_SESSION['user'],
            'id' => $id
        ]);
    }
}
