<?php
namespace App\Lib\rb;

class ModelFormatter implements \RedBean_IModelFormatter {
    public function formatModel($model) {
        $model = ucfirst($model);
        $tmp = explode('_',$model);
        if(isset($tmp[1])){
            $parts = array();
            foreach($tmp as $part){
                $parts[] = ucfirst($part);
                $model   = implode("", $parts);
            }
        }  
        return '\\App\\'.'Models'.'\\'.$model;
    }
}
