<?php

namespace Rapido\Http;

class Header 
{
    private array $values = [];

    public function set(string $key, string $value)
    {
        $this->values[$key] = [$value];
        
        return $this;

    }

    public function add(string $key, $value)
    {

        $this->values[$key][] = $value;
        return $this;
    }
    
    public function has(string $key) : bool
    {
        return isset($this->values[$key]);

    }

    public function get(string $key) : array
    {
        return $this->values[$key];

    }

    public function remove(string $key){
        unset($this->values[$key]);

        return $this;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Content-Type: value1, value2, value3
     */

    public function getLine(string $key): string
    {

        return sprintf(' %s', implode(', ', $this->get($key)));

    }

    public function __toString()
    {
        $str = '';

        foreach ($this->getValues() as $key => $values){
            
            $str .= sprintf("%s: %s \n", $key, $this->getLine($key));
        }

        return $str;
    }
}


?>