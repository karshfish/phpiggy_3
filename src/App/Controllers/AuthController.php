<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine as TE;
use App\Services\{ValidatorService as VS, UserService as US};

class AuthController
{
    public function __construct(
        private TE $view,
        private VS $validatorService,
        private US $userService
    ) {}
    public function registrationView()
    {
        $this->view->render('registration.php', [
            'title' => 'Sign up'

        ]);
    }
    public function register()
    {
        $this->validatorService->validateRegister($_POST);
        $this->userService->isEmailTaken($_POST['e-mail']);
        $this->userService->createUser($_POST);
        redirectTo('/');
    }
}
