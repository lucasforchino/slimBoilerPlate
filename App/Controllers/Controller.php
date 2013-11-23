<?php
namespace App\Controllers;

class Controller
{
    /**
     *
     * @var \Slim\Slim 
     */
    protected $app  = false;
    
    /**
     * @var \App\Models\Users
     */
    protected $user = false;
    /**
     *
     * @var Array
     */
    protected $view = array();
    
    
    
    public function __construct()
    {
        $this->app  = \Slim\Slim::getInstance();
        $this->init();
    }
    public function init()
    {}
    
    
    public function errorUnless($value,$message=false,$code=404)
    {
        if(!$value){
            $this->app->halt($code,$message);
        }
    }
    
    
    public function ajax()
    {
        if(!$this->app->request()->isAjax()){
            $this->app->halt(404,'Page not found.');
        }
    }
    
    public function renderJson($dataArray,$httpCode = 200)
    {
        $response = $this->app->response();
        $response['Content-Type'] = 'application/json';
        $response->status($httpCode);
        $response->body(json_encode($dataArray));        
    }
    
    public static function call($controller,$action,$args = array())
    {
        $namespace  = '\\App\\Controllers\\';
        $className  = $namespace.$controller.'Controller';
        $obj        = new $className();
        call_user_func_array(array($obj,$action),$args);
    }
}