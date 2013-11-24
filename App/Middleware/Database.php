<?php
namespace App\Middleware;
use Slim\Middleware;

class Database extends Middleware
{
    public function call()
    {
        $database = new \App\Services\Database();
        $database->initialize();
        
        $this->next->call();
    }
}
