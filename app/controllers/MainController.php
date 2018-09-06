<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

/**
 * Description of MainControllers
 *
 * @author grajdanin
 */
class MainController extends AppController {
      
    public function indexAction() {
        $this->setMeta(\myshop\App::$registry->getProperty('shop_name'), 
                $desc = 'описание', $keywords = 'ключевые');
        $holop = 'holop # 2340';
        $time = time();
        $this->setData(compact('holop', 'time'));
    }
}
