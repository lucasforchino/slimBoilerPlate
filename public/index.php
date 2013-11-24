<?php

define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../App'));
defined('ENVIRONMENT') || define('ENVIRONMENT', (getenv('ENVIRONMENT') ? getenv('ENVIRONMENT') : 'production'));


// composer autoload
require APPLICATION_PATH.'/../vendor/autoload.php';


//config
$config = \App\Services\Config::getInstance(ENVIRONMENT)->getConfig();

//get slim $app
$app    = new \Slim\Slim($config);
$app->add(new \App\Middleware\Layout());
$app->add(new \App\Middleware\Database());


//include routes
require APPLICATION_PATH.'/Routes/routes.php';

//run app
$app->run();



