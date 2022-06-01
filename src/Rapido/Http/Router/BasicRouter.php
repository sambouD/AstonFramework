<?php

namespace Rapido\Http\Router;

class BasicRouter extends AbstractRouter
{
    public function match(): ?Route
    {
        $path = $this->getRequest()->getUri()->getPath();
        $method = $this->getRequest()->getMethod();

        if (!isset($this->routes[$path])) {
            return null;
        }

        $route = $this->routes[$path];

        if (!$this->hasMethod($route, $method)) {
            return null;
        }

        return $route;
    }
}