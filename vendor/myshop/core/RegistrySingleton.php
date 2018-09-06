<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace myshop;

/**
 * Description of RegistrySingelton
 *
 * @author grajdanin
 */
class RegistrySingleton {
    
    /* @return RegistrySingleton */
    use SingletonTrait;
    
    private static $properties = [];
    
    public function setProperty($key, $value){
        if (!isset(self::$properties[$key])){
            self::$properties[$key] = $value;
        } else { 
            trigger_error('Variable '. $key .' already defined', E_USER_WARNING);
        }
    }
    
    public function getProperty($key){
        if (isset(self::$properties[$key])){
            return self::$properties[$key];
        } else {
            return NULL;
        }
    }
    
    public function getProperties(){
        return self::$properties;
    }
}
