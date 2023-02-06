<?php

namespace App\core;

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    protected $binding = [];

    public function __construct()
    {
        $uri = $this->parseUrl();
        if (file_exists('../app/controllers/' . $uri[0] . '.php')) {
            $this->controller = $uri[0];
            unset($uri[0]);
        }
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';

        $class = "App\\controllers\\{$this->controller}";
        $controllerObj = $this->resolveClassDependencies($class);
        dd($controllerObj);
        if (!empty($uri[1])) {
            if (method_exists($controllerObj, $uri[1])) {
                $this->method = $uri[1];
                unset($uri[1]);
            }
        }

        $this->params = $uri ? array_values($uri) : [];
        $params = $this->params;
        $this->resolveMethodDependencies($class, $this->method);
        $result = call_user_func_array([$controllerObj, $this->method], $params);
        if ($result instanceof Response) {
            return $result->toResponse();
        }
        $response = new Response($result);

        $response->toResponse();
    }

    public function parseUrl()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = trim($_SERVER['REQUEST_URI'], '/'); // remove first /
            $uri = filter_var($uri, FILTER_SANITIZE_URL); // validate uri
            return explode('/', $uri); // explode to array
        }
    }

    private function resolveClassDependencies($class)
    {
        $reflection = new \ReflectionClass($class);
        if ($reflection->getConstructor() and empty($reflection->getConstructor()->getParameters())) {
            return new $class;
        }
        if (empty($reflection->getConstructor()))
        {
            return new $class;

        }
        foreach ($reflection->getConstructor()->getParameters() as $parameter) {
            if ($parameter->getType()) {
                $paramClass =  $parameter->getType()->getName();

                $this->binding[] = $this->resolveClassDependencies($paramClass);
            }
        }

        return new  $class(...$this->binding);
    }

    public function resolveMethodDependencies($class, $method)
    {
        $reflection = new \ReflectionClass($class);
        if ($reflection->hasMethod($method) and !empty($reflection->getMethod($method)->getParameters())) {
            foreach ($reflection->getMethod($method)->getParameters() as $parameter) {
            }
        }
    }

    public function make($concrete)
    {
        $callable = $this->binding[$concrete] ?? null;

        if ($callable !== null) {
            return $callable;
        }

    }


}