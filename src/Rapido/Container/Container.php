<?php

namespace Rapido\Container;

use Exception;

class Container {
private $services = [];

public function register(string $id, $value): self
{

    $this->services[$id] = $value;

    return $this;
}


public function singleton(string $id,callable $value) :self
{

        return $this->register($id, function() use ($value) {
                static $service = null;

                if($service == null){
                    $service = $value($this);
                }

                return $service;
        });
}
public function protected(string $id, $value) : self
{  
    return $this->register($id, function() use ($value ){
    return $value;
    });

}

public function get(string $id)
{
    if(!$this->has($id)){
        throw new Exception("Service $id not found");
    }
    
    $service = $this->services[$id];
    if (!is_callable($service)) {
        # code...
        return $service;
    }
    return $service($this);
}

public function has(string $id) : bool
{


    return isset($this->services[$id]);
}

}