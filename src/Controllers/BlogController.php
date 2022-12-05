<?php
namespace App\Controllers;

use App\Core\BaseController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BlogController extends BaseController
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function index($parameters)
    {
        $this->view('/blog/index.html.twig', array('data' => $parameters));
    }
}
