<?php
/**
 * @author    Prince Lonappan
 */

namespace App\Helpers;

use App\Controllers\IndexController;

/**
 * Class Router.
 */
class Router
{
    private $defaultMethod = 'index';
    /**
     * @var Request
     */
    private $request;
    /**
     * @var CommonHelper
     */
    private $commonHelper;
    private $errorMessage;
    private $errorStatusCode;

    public function __construct(Request $request, CommonHelper $commonHelper)
    {
        $this->request = $request;
        $this->commonHelper = $commonHelper;
    }

    /**
     * Router Initial method
     * @return void
     */
    public function run(): void
    {
        if ($this->request->isSlash()) {
            $this->handleDefaultRoute();
        } else {
            $this->handleRoute();
        }
    }

    /**
     * Handle the route based on the request url
     * @return void
     */
    private function handleRoute()
    {
        $reqController = $this->request->getController();
        $reqParam = $this->request->getParameters();
        $reqControllerPath = $this->commonHelper->getControllerPath($reqController);
        if (!file_exists($reqControllerPath)) {
            //return the 404 error page
            $this->errorMessage = '404, route not found!';
            $this->errorStatusCode = 404;
            $this->trigger404();
        }

        if ($this->request->validateParameters()) {
            try {
                //Include the controller and default method.
                require_once $reqControllerPath;
                $controller = "\App\Controllers\\" . ucfirst($reqController) . 'Controller';
                $controllerObj = new $controller();
                $method = $this->defaultMethod;
                if (method_exists($controllerObj, $method)) {
                    print $controllerObj->$method($reqParam);
                } else {
                    $this->errorMessage = 'Invalid method.';
                    $this->errorStatusCode = 400;
                    $this->trigger404();
                }
            } catch (\Exception $e) {
                // fallback, in case of other exception
                $this->errorMessage = 'Some error occurred.';
                $this->errorStatusCode = 400;
                $this->trigger404();
            }
        } else {
            //return the 400 error page
            $this->errorMessage = 'Invalid parameters';
            $this->errorStatusCode = 400;
            $this->trigger404();
        }
    }

    private function trigger404()
    {
        header('HTTP/1.1 ' . $this->errorStatusCode . 'Not Found');
        die($this->errorMessage);
    }

    private function handleDefaultRoute()
    {
        $indexController = new IndexController();
        print $indexController->index();
    }
}
