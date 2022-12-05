<?php
namespace App\Controllers;

use App\Core\BaseController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ProductController extends BaseController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index($parameters)
    {
        $this->view('/product/index.html.twig', array('data' => $parameters));
    }
}
