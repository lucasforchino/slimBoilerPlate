<?php

namespace App\Services;

class Config
{

    const DEVELOPMENT = 'development';
    const STABLE = 'stable';
    const PRODUCTION = 'production';
    
    
    private $environment   = null;
    private $config = array();
    private static $configInstance = false;

    
    
    private function __construct($environment)
    {
        $this->environment = $environment;
    }
    
    /**
     * 
     * @return \App\Services\Config
     */
    public static function getInstance($environment = false)
    {
        if (!self::$configInstance) {
            self::$configInstance = new Config($environment);
        }
        return self::$configInstance;
    }

    public function getConfig()
    {
        if (!isset($this->config[$this->environment])) {
            switch ($this->environment) {
                case self::DEVELOPMENT:
                    $config = self::getDevelopmentConfig();
                    break;
                case self::STABLE:
                    $config = self::getStableConfig();
                    break;
                case self::PRODUCTION:
                default:
                    $config = self::getProductionConfig();
                    break;
            }
            $this->config[$this->environment] = $config;
        }
        return $this->config[$this->environment];
    }

    public function getConfigSection($section)
    {
        $configArray = $this->getConfig();
        return $configArray[$section];
    }

    private static function getDevelopmentConfig()
    {
        $prod = require APPLICATION_PATH . '/Config/config.php';
        $local = require APPLICATION_PATH . '/Config/config_local.php';
        $config = self::merge($prod, $local);
        return $config;
    }

    private static function getStableConfig()
    {
        $prod = require APPLICATION_PATH . '/Config/config.php';
        $stable = require APPLICATION_PATH . '/Config/config_stable.php';
        $config = self::merge($prod, $stable);
        return $config;
    }

    private static function getProductionConfig()
    {
        $config = require APPLICATION_PATH . '/Config/config.php';
        return $config;
    }

    private static function merge($array, $array2)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (isset($array2[$key])) {
                    $res = self::merge($value, $array2[$key]);
                    $array[$key] = $res;
                }
            } else {
                $array[$key] = isset($array2[$key]) ? $array2[$key] : $array[$key];
            }
        }
        return $array;
    }

}
