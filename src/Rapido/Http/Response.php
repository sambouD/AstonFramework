<?php

namespace Rapido\Http;

use Rapido\Http\Header;

class Response{
    
    private Header $header; 
    private $status = 200;
    private string $body;


    
    public function send(string $body)
    {
        $this->setBody($body);
        
        http_response_code($this->getStatus());

        foreach ($this->getHeader()->getValues() as $key => $values)
        {
            foreach($values as $value){
                header(sprintf('%s: %s', $key, $value)); // Header c'est une fonction 
            }
        }

        $stream = fopen('php://output', 'w');
        $octets = fwrite($stream, $this->getBody());

        fclose($stream);
        
        return $octets;
    }

  


    //Get et set Status
    public function getStatus() : ?int
    {
        return $this->status;
    }

    public function setStatus(int $status) : self
    {
        
        $this->status = $status;
        return $this; 
    }
   

    // Get et set Body
    public function getBody() : string
    {
        return $this->body;
    }

    public function setBody( string $body) : self
    {
        $this->body = $body;
        return $this;
    }

    // Get et Set Header
    public function getHeader() : Header
    {
        return $this->header;
    }

    public function setHeader(Header $header) : self
    {
        $this->header = $header;
        return $this;
    }
    
}



?>