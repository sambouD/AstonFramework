<?php

namespace Rapido\Http\Router;


class Route
{
    private $method;
    private $path = '';
    private array $params = [];
    private $action;

    public function __construct( $method, string $path, callable $action)
    {
        $this->setMethod($method)
            ->setPath($path)
            ->setAction($action);
    }

    public function getAction(): callable
    {
        return $this->action;
    }

    public function setAction(callable $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method): self
    {
        $this->method = $method;

        return $this;
    }
}