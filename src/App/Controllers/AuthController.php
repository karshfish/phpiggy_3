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
        private US $userservice
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
        $this->userservice->isEmailtaken($_POST['e-mail']);
        $this->userservice->createUser($_POST);
        redirectTo('/');
    }
}
