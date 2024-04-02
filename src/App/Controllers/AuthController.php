<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine as TE;

class AuthController
{
    public function __construct(private TE $view)
    {
    }
    public function registrationView()
    {
        $this->view->render('registration.php', [
            'title' => 'Sign up'

        ]);
    }
    public function register()
    {
        dd($_POST);
    }
}
