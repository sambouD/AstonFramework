<?php 

namespace Rapido\Http;

use Rapido\Http\Uri;

class Request
{

    private array $params = [];
    private array $queryParams = []; 
    private string $method = 'GET';
    private string $body = ''; 
    private Uri $uri; 
    
}



?>