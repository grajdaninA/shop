<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace myshop;

/**
 * Description of ShopException
 * нужно сделать обсервер
 * @author grajdanin
 */
class ShopException {
    public function __construct() {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
    }
    
    public function exceptionHandler($err){
        $this->logErrors($err->getMessage(), $err->getLine(), $err->getFile());
        $this->viewErrors('exception:', $err->getMessage(), $err->getLine(), 
                $err->getFile(), $err->getCode());
    }
    
    protected function logErrors($msg = '', $line = '', $file = ''){
        $message = "[" . date('Y-m-d H:i:s') . "] error: {$msg} | line: {$line}"
        . " | file: {$file} \n";
        error_log($message, 3, ROOT . '/tmp/errors.log');
    }
    
    protected function viewErrors($errno, $msg, $line, $file, $response){
        http_response_code($response);
        if (!DEBUG && $response == 404) {
            require WWW . '/errors/404.php';
            die;
        }
        if (DEBUG) {
            require WWW . '/errors/devel.php';
        } else {
            require WWW . '/errors/prod.php';
        }
        die;
    }
}
