<?php

use myshop\Router;

//default routes for admins
Router::addRoute('^admin$', ['controller' => 'Main', 'action' => 'index', 
    'prefix' => 'admin']);
Router::addRoute('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', 
        ['prefix' => 'admin']);

// default routes for users
Router::addRoute('^$', ['controller' => 'Main', 'action' => 'index']);
Router::addRoute('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$' );


