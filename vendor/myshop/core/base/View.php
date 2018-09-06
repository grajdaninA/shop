<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace myshop\base;

/**
 * Description of AbstractView
 *
 * @author grajdanin
 */
class View {
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $meta = [];
    public $data = [];
    public $layot;

    public function __construct($route, $meta, $layot = '', $view = '') {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $view;
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if ($layot === FALSE) {
            $this->layot = FALSE;
        } else {
            $this->layot = $layot ?: LAYOUT;
        }
    }
    
    public function render($data){
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/"
        . "{$this->view}.php";
        if (is_file($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        } else {
            throw new \Exception("View {$viewFile} not found", 500);
        }
        if($this->layot !== FALSE){
            $layoutFile  = APP . "/views/layouts/{$this->layot}.php";
            if (is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new \Exception("Layot {$layoutFile} not found", 500);
            }
        }


    }
}
