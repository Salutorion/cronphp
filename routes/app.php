<?php

$router->add('home', [
    'controller' => 'HomeController' ,
    'action' => 'index',
]);

$router->add('getList', [
    'controller' => 'CronController' ,
    'action' => 'getList',
]);

$router->add('getCron', [
    'controller' => 'CronController' ,
    'action' => 'getCron',
]);

$router->add('deleteCron', [
    'controller' => 'CronController' ,
    'action' => 'deleteCron',
]);

$router->add('editCron', [
    'controller' => 'CronController' ,
    'action' => 'editCron',
]);

$router->add('addCron', [
    'controller' => 'CronController' ,
    'action' => 'addCron',
]);

