<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace myshop;

/**
 * Description of Router
 *
 * @author grajdanin
 */
class Router {
    
    public static $routes = [];
    public static $route = [];
    
    public static function addRoute($regexp, $route = ''){
        self::$routes[$regexp] = $route;
    }
    
    public static function getRoutes(){
        return self::$routes;
    }
    
    public static function getRoute(){
        return self::$route;
    }
    
    public static function dispatch($url){
        if(self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::$route['prefix'] . 
            self::$route['controller'] . 'Controller';
            if(class_exists($controller)) {
                $controllerObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 
                        'Action';
                if(method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                    $controllerObj->getView();
                } else {
                    throw new \Exception("Method $controller::$action "
                            . "not found", 404);
                }
            } else {
                throw new \Exception("Class $controller not found", 404);
            }
        } else {
            throw new \Exception('Page not found', 404);
        }
    }
    
    public static function matchRoute($url){
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '/';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = self::lowerCamelCase($route['action']);
                self::$route = $route;
                return TRUE;
            }
        }
        return FALSE;
    }
    
    // NameClassController
    protected static function upperCamelCase($name) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }
    
    // methodName
    protected static function lowerCamelCase($name) {
        return lcfirst(self::upperCamelCase($name));
    }
}
