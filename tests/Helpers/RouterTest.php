<?php

namespace App\Tests\Helpers;

use PHPUnit\Framework\TestCase;
use App\Helpers\Router;
use App\Helpers\CommonHelper;
use App\Helpers\Request;

class RouterTest extends TestCase
{
    public function testUri()
    {
        $commonHelper = new CommonHelper();
        $request = new Request();
        // Create Router
        $_SERVER['PATH_INFO'] = '/blog';
        $router = new Router($request, $commonHelper);
        ob_start();
        $router->run();
        $this->assertNotEmpty(ob_get_contents());
        // Cleanup
        ob_end_clean();
    }
}