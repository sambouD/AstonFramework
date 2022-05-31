<?php

// init_set('display_errors', 'On');
use Rapido\Http\Header;
use Rapido\Http\Request;
use Rapido\Http\Response;
use Rapido\Http\Router;
use Rapido\Http\Uri;

require '../vendor/autoload.php';

// $uri = new Uri('http://user:pass@localhost:3000/blog/articles?name=joe#hello');
$uri = new Uri($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$request = new Request($uri);
$request->setServerParams($_SERVER);


$header = new Header();
$response = new Response(); 
//
$router = new Router();


$response->setHeader($header);

$header->set('Content-Type', 'text/html; charset=utf-8')
        ->set('My-name-is', ' Douc')
        ->add('Cool', "")
        ->remove('Douc');


$response->setStatus(200)->send($request->getBody() . ' ' . $request->getMethod());

        
// echo $uri->getHost(), '<br>';
// echo $uri->getPath(), '<br>';
// echo $uri->getPort(), '<br>';
// echo $uri->getUser(), '<br>';
// echo $uri->getPass(), '<br>';
// echo $uri->getFragment(), '<br>';
// echo $uri->getQuery(), '<br>';

// var_dump( $_SERVER);
              


?>