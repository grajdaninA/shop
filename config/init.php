<?php

ini_set('display_errors', 1);

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . "/public");
define("APP", ROOT . "/app");
define("CORE", ROOT . "/vendor/myshop/core");
define("LIBS", ROOT . "/vendor/myshop/libs");
define("CASHE", ROOT . "/tmp/cashe");
define("LAYOUT", "default");
define("COMPOSER", ROOT . "/vendor");
define("CONF", ROOT . "/config");

//http://myshop.by/public/index.php
$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace('/(https?:\/\/[\w\.]+)(\/[\w\.\/]+)/', '\1' , $app_path);

define("URL", $app_path);
define("ADMIN", URL . "/admin");

require_once COMPOSER . '/autoload.php';