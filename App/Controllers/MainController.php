<?php
namespace App\Controllers;
use RedBean_Facade as R;

class MainController extends Controller
{

    public function init()
    {}
    
    public function index()
    {
        $user = R::dispense('users');
        $this->view['user'] = $user;
        $this->app->render('main/index.php', $this->view);
    }
    public function error()
    {
        $this->app->render('main/404.php', $this->view);
    }
}