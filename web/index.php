<?php

ini_set('display_errors', 'On');

use Rapido\App\Rapido;
use Rapido\Container\Container;
use Rapido\Http\Request;
use Rapido\Http\Response;

require '../vendor/autoload.php';
require './config/services.php';

$container = initServices(new Container());
$app = new Rapido($container);

$app->get('/blog/articles/add', function (Request $req, Response $res) use ($container) {
    $db = $container->get('db');

    $res->send('<h1>Hello World</h1>');
});

try {
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage();
}