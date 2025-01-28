<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine as TE;
use App\Services\ValidatorService as VS;
use Framework\Database as DB;

class LoginController
{
    public function __construct(
        private TE  $view,
        private VS $validateService
    ) {}
    public function viewLogin()
    {
        $this->view->render('login.php', [
            'title' => 'Login'
        ]);
    }
    public function login()
    {
        $this->validateService->validateLogin($_POST);
    }
}
