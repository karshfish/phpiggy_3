<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine as TE;
use App\Config\Paths as PATH;

class AboutController
{
    private TE $view;
    public function __construct()
    {
        $this->view = new TE(PATH::VIEW);
    }
    public function About()
    {
        $this->view->render('about.php', ['github' => 'https://github.com/karshfish']);
    }
}
