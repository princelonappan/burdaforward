<?php
require 'bootstrap.php';
use App\Helpers\Router;
use App\Helpers\Request;
use App\Helpers\CommonHelper;

$request = new Request();
$commonHelper = new CommonHelper();

$router = new Router($request, $commonHelper);
$router->run();