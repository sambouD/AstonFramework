<?php

namespace Rapido\Http\Router;

class RegexRouter extends AbstractRouter
{
    // #^/articles/([0-9]+)$#
    // /articles/([0-9]+)
    public function addRoute( $method, string $path, callable $action): self 
    {
        return parent::addRoute($method, '#^'.$path.'$#', $action);
    }

    public function match(): ?Route
    {
        $path = $this->getRequest()->getUri()->getPath();
        $method = $this->getRequest()->getMethod();
        $params = [];

        foreach ($this->routes as $regex => $route) {
            if ($this->hasMethod($route, $method) && preg_match($regex, $path, $params)) {
                array_shift($params);

                $route->setParams($params);
                $this->getRequest()->setParams($params);

                return $route;
            }
        }

        return null;
    }
}