<?php

namespace Rapido\Http;

use Rapido\Http\Router\Route;

interface Router
{
    public function match(): ?Route;

    public function addRoute($method, string $path, callable $action);

    public function setRequest(Request $request): self;

    public function getRequest(): Request;
}