<?php
namespace App\Middleware;
use Slim\Middleware;

class Layout extends Middleware
{
    public function call()
    {
        $configService = \App\Services\Config::getInstance();
        $layoutConfig  = $configService->getConfigSection('layout');
        $view   = new \App\Lib\Slim\View();
        \App\Lib\Slim\View::set_layout($layoutConfig);
        $app = \Slim\Slim::getInstance();
        $app->view($view);
        $this->next->call();
    }
}