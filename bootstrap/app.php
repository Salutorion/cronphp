<?php

require dirname(__DIR__) . '/vendor/autoload.php';

require dirname(__DIR__) . '/framework/Router.php';

$url = $_SERVER['REQUEST_URI'];

$router = new Core\Router();

require dirname(__DIR__) . '/routes/app.php';

header('Content-Type:application/json;charset=utf-8');

$router->dispatch($url);