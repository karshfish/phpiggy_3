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
        $searchTerm = $_GET['s'] ?? NULL;
        [$transactions, $count] = $this->ts->findTransactions($length, $offset);
        $lastPage = ceil($count / $length);
        $pages = $lastPage ? range(1, $lastPage) : [];
        $pagesLinks = array_map(
            fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' => $searchTerm
            ]),
            $pages
        );

        echo $this->view->render("/index.php", [

            'transactions' => $transactions,
            'currentPage' => $page,
            'previousPageLink' => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm
            ]),
            'lastPage' => $lastPage,
            'nextPageLink' => http_build_query(
                [
                    'p' => $page + 1,
                    's' => $searchTerm
                ]
            ),
            'searchTerm' => $searchTerm,
            'pageLinks' => $pagesLinks

        ]);
    }
}
