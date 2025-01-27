<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine as TE;
use Framework\Database as DB;

class LoginController
{
    public function __construct(
        private TE  $view
    ) {}
    public function viewLogin()
    {
        $this->view->render('login.php', [
            'title' => 'Login'
        ]);
    }
}
