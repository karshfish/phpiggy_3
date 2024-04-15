<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine as TE;
use App\Config\Paths;

class HomeController
{

    public function __construct(private TE $view)
    {
        // var_dump($this->view);
    }
    public function home()
    {
        $MyName = 'Fady';
        echo $this->view->render("/index.php", [
            'Name' => $MyName,

        ]);
    }
}
