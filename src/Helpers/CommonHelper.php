<?php

namespace App\Helpers;

class CommonHelper
{
    /**
     * Return the file path
     * @param $controllerName
     * @return string
     */
    public function getControllerPath($controllerName): string
    {
        return $_SERVER['DOCUMENT_ROOT'].'/src/Controllers/' . ucfirst($controllerName) . 'Controller.php';
    }
}
