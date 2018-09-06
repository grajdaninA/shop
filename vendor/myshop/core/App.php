<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace myshop;

/**
 * Description of App
 *
 * @author grajdanin
 */
class App {
     
    public static $registry;

    public function __construct() {
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();      
        self::$registry = RegistrySingleton::getInstance();
        $this->setParams();
        new ShopException();
        Router::dispatch($query);
    }
    
    protected function setParams(){
        $params = require_once CONF. '/params.php';
        if(!empty($params)){
            foreach ($params as $key => $value) {
                self::$registry->setProperty($key, $value);
            }
        }
    }
}
