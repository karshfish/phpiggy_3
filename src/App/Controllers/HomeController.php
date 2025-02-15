<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine as TE;
use App\Services\TransactionService as TS;
use App\Config\Paths;

class HomeController
{

    public function __construct(
        private TE $view,
        private TS $ts
    ) {
        // var_dump($this->view);
    }
    public function home()
    {
        $transactions = $this->ts->findTransactions();
        $MyName = 'Fady';
        echo $this->view->render("/index.php", [
            'Name' => $MyName,
            'transactions' => $transactions

        ]);
    }
}
