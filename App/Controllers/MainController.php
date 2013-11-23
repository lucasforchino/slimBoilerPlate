<?php
namespace App\Controllers;
use App\Slim\View;


class MainController extends Controller
{

    public function ini()
    {
        View::set_layout('_layouts/layout.php');
    }
    public function index()
    {
        $this->app->render('main/index.php', $this->view);
    }
    public function error()
    {
        $this->app->render('main/404.php', $this->view);
    }
    public function message()
    {
        $this->app->render('main/message.php', $this->view);
    }
}