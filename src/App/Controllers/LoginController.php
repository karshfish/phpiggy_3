<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine as TE;
use App\Services\{ValidatorService as VS, UserService as US};
use Framework\Database as DB;

class LoginController
{
    public function __construct(
        private TE  $view,
        private VS $validateService,
        private US $userServices
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
        $this->userServices->login($_POST);
        redirectTo('/');
    }
}
