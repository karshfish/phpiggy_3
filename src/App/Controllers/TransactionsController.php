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
    }
    public function deleteTransaction() {}
}
