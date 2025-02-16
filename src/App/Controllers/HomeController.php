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
        $page = $_GET['p'] ?? 1;
        $page = (int)$page;
        $length = $_GET['l'] ?? 5;
        $length = (int)$length;
        $offset = ($page - 1) * $length;
        $transactions = $this->ts->findTransactions($length, $offset);

        echo $this->view->render("/index.php", [

            'transactions' => $transactions

        ]);
    }
}
