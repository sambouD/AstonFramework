<?php

// init_set('display_errors', 'On');
use Rapido\Http\Header;
use Rapido\Http\Response;
use Rapido\Http\Uri;

require '../vendor/autoload.php';

$uri = new Uri('https://www.php.net/manual/fr/language.references.return.php');

$header = new Header();
$response = new Response();
$response->setHeader($header);

$header->set('Content-Type', 'text/html; charset=utf-8')
        ->set('My-name-is', ' Douc')
        ->add('Cool', "")
        ->remove('Douc');


$response->setStatus(404)->send('<h1>Hello World</h1>');

        

              


?>