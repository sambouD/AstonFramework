<?php

namespace Rapido\Http\Router; 


use Rapido\Http\Request;
use Rapido\Http\Router;

abstract class AbstractRouter implements Router
{
    protected array $routes = [];
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->setRequest($request);
    }

    protected function hasMethod(Route $route, string $method): bool
    {
        if (is_array($route->getMethod()) && !in_array($route->getMethod(), $method)) {
            return false;
        }
    
        if ($route->getMethod() !== $method) {
            return false;
        }

        return true;
    }

    public function addRoute( $method, string $path, callable $action): self
    {
        $this->routes[$path] = new Route($method, $path, $action);

        return $this;
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}