<?php
namespace App\Services;

use RedBean_Facade as R;
use App\Lib\rb\ModelFormatter;
use RedBean_ModelHelper;

class Database 
{
    public function initialize()
    {
        $configService = Config::getInstance();
        $dbConfig   = $configService->getConfigSection('database');
        
        $host       = $dbConfig['host'];
        $dbName     = $dbConfig['dbName'];
        $user       = $dbConfig['user'];
        $pass       = $dbConfig['pass'];
        
        
        R::setup('mysql:host='.$host.';dbname='.$dbName,$user,$pass);
        R::freeze( true );
        R::setStrictTyping( false );
        
        $formatter = new ModelFormatter;
        RedBean_ModelHelper::setModelFormatter($formatter);
        
    }
}
