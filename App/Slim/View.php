<?php
namespace App\Slim;
class View extends \Slim\View
{
    
    static protected $_layout = NULL;
    static protected $_disableLayout = false;
    
    
    
    public static function disableLayout($val = true)
    {
        self::$_disableLayout = $val;
    }
    
    
    
    public static function set_layout($layout=NULL)
    {
        self::$_layout = $layout;
    }
    
    
    
    
    public function render( $template ) {
        $templatePath = $this->getTemplatesDirectory() . '/' . ltrim($template, '/');
        if ( !file_exists($templatePath) ) {
            throw new \RuntimeException('View cannot render template `' . $templatePath . '`. Template does not exist.');
        }
        extract($this->data);
        ob_start();
        require $templatePath;
        $html = ob_get_clean();
        if (self::$_disableLayout){
            return $html;
        }else{
            return $this->_render_layout($html);
        }
        
    }
    public function _render_layout($_html)
    {
        if(self::$_layout !== NULL){
            $layout_path = $this->getTemplatesDirectory() . '/' . ltrim(self::$_layout, '/');
            if ( !file_exists($layout_path) ) {
                throw new \RuntimeException('View cannot render layout `' . $layout_path . '`. Layout does not exist.');
            }
            extract($this->data);
            ob_start();
            require $layout_path;
            $_html = ob_get_clean();
        }
        return $_html;
    }

}

