<?php
namespace App\Middleware;
use Slim\Middleware;

class Layout extends Middleware
{
    public function call()
    {
        
        $view   = new \App\Slim\View();
        \App\Slim\View::set_layout('_layouts/panel.php');
        $app = \Slim\Slim::getInstance();
        $app->view($view);
        
        
        
        $this->next->call();
    }
}