<?php

use App\Controllers\Controller;


/* Main */

$app->get('/', function (){
    Controller::call('Main','index',func_get_args());
});

$app->get('/404', function (){
    Controller::call('Main','error',func_get_args());
});
