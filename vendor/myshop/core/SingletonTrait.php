<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace myshop;

/**
 *
 * @author grajdanin
 */
trait SingletonTrait {
    
    private static $instance;
   
    public static function getInstance(){
        if (self::$instance === NULL) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
