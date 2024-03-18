<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine as TE;
use App\Config\Paths;

class HomeController
{
    private TE $view;
    public function __construct()
    {
        $this->view = new TE(Paths::VIEW);
    }
    public function home()
    {
        $MyName = 'Fady';
        echo $this->view->render("/index.php", ['Name' => $MyName]);
    }
}
