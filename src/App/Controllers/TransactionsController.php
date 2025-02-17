<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService as VS, TransactionService as TS};


class TransactionsController
{
    public function __construct(
        private TemplateEngine $view,
        private VS $validatorService,
        private TS $ts
    ) {}

    public function createView()
    {
        echo $this->view->render("transactions/create.php");
    }
    public function createTransaction()
    {
        $this->validatorService->validateCreate($_POST);
        $this->ts->create($_POST);
        redirectTo('/');
    }
    public function editTransactionView(array $params)
    {
        $transaction = $this->ts->getUserTransaction($params['transaction']);
        if (!$transaction) {
            redirectTo('/');
        }
        $this->view->render(
            "transactions/edit.php",
            ['transaction' => $transaction]
        );
    }
    public function editTransaction($params)
    {
        $transaction = $this->ts->getUserTransaction($params['transaction']);
        if (!$transaction) {
            redirectTo('/');
        }
        $this->validatorService->validateCreate($_POST); //Creation validation and edit validation are the same
        $this->ts->editTransaction($_POST, $params['transaction']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }
    public function deleteTransaction($params)
    {
        $transaction = $this->ts->getUserTransaction($params['transaction']);
        if (!$transaction) {
            redirectTo('/');
        }
        $this->ts->delete($transaction['id']);
        redirectTo('/');
    }
}
