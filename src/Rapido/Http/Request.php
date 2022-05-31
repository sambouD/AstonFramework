<?php 

namespace Rapido\Http;

use Rapido\Http\Uri;

class Request
{

    private array $params = [];     //cart/product/{20}
    private array $queryParams = []; // ?name=toto&age=30
    private array $serverParams = []; // $_SERVER
    private string $method = 'GET'; 
    private ?string $body = null; 
    private Uri $uri; 
    
    public function __construct(Uri $uri)
    {
        $this->setUri($uri);
        
    }

    /**
     * Get the value of params
     */ 
    public function getParams() : array
    {
        return $this->params;
    }

    /**
     * Set the value of params
     *
     * @return  self
     */ 
    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get the value of queryParams
     */ 
    public function getQueryParams() : array
    {
        return $this->queryParams;
    }

    /**
     * Set the value of queryParams
     *
     * @return  self
     */ 
    public function setQueryParams(array $queryParams)
    {
        $this->queryParams = $queryParams;

        return $this;
    }

    /**
     * Get the value of method
     */ 
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @return  self
     */ 
    public function setMethod(string $method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the value of body
     */ 
    public function getBody() : string
    {
        if(is_null($this->body)){

            $this->body = file_get_contents('php://input');
        }
        return (string) $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody(?string $body)
    {
        $this->body = $body;

        return $this;
    }
    

    /**
     * Get the value of uri
     */ 
    public function getUri() : Uri
    {
        return $this->uri;
    }

    /**
     * Set the value of uri
     *
     * @return  self
     */ 
    public function setUri(Uri $uri)
    {
        $queryParams = [];
        parse_str($uri->getQuery(), $queryParams);
        $this->setQueryParams($queryParams);
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get the value of serverParams
     */ 
    public function getServerParams() : array
    {
        return $this->serverParams;
    }

    /**
     * Set the value of serverParams
     *
     * @return  self
     */ 
    public function setServerParams( array $serverParams)
    {
        $this->setMethod($serverParams['REQUEST_METHOD'] ?? 'GET');

        $this->serverParams = $serverParams;

        return $this;
    }
}



?>