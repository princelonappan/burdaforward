<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    /**
     * Render the twig view template.
     *
     * @param $templateName
     * @param $data
     * @return void
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function view($templateName, $data = array())
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../src/Views');
        $twig = new Environment($loader);
        echo $twig->render($templateName, $data);
    }
}
