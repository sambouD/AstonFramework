<?php

namespace Rapido\Http;

use Rapido\Http\Request;
use Rapido\Http\Router\Route;


class Router
{

    public function match(): ?Route;
    
    public function addRoute(string $method, string $path, callable $action);

    public function setRequest(Request $request): self;
    public function getRequest(): Request;
    
}





?>