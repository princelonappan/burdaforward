<?php

namespace App\Helpers;

class Request
{
    public $params;
    public $path;
    private $paramPattern= '(\d+(/\d+(/\d+?)?)?)?';
    private $defaultParameterCount = 3;
    private $server;

    public function __construct()
    {
        $this->getPathInfo();
    }

    /**
     * Get the controller name from URL
     * @return mixed|string
     */
    public function getController()
    {
        $this->server = $this->getPathInfo();
        return $this->server[1];
    }

    /**
     * Return the parameters.
     * @return array
     */
    public function getParameters(): array
    {
        return array_slice($this->server, 2, $this->defaultParameterCount);
    }

    /**
     * Return server path
     * @return false|string|string[]
     */
    private function getPathInfo()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $this->path = $_SERVER['PATH_INFO'];
            $server = $this->pathSplit($this->path);
        } else {
            $this->path = '/';
            $server = '/';
        }
        return $server;
    }

    private function pathSplit($path)
    {
        return explode('/', $path);
    }

    private function getParameterString(): string
    {
        return implode("/", $this->getParameters());
    }

    public function isSlash(): bool
    {
        return $this->path == '/';
    }

    /**
     * Validate the request parameters based on the regex expression.
     * @return bool
     */
    public function validateParameters(): bool
    {
        $parameters = $this->getParameters();
        if (!empty($parameters[0])) {
            $array = array();
            return boolval(preg_match_all('#^' . $this->paramPattern . '$#', $this->getParameterString(),
                $array, PREG_OFFSET_CAPTURE));
        } else {
            return true;
        }
    }
}
