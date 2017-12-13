<?php
define('ROOT_DIR', __DIR__);
require 'vendor/autoload.php';
require 'system/controller.php';
require 'system/model.php';

$get = &$_GET;
$controller = 'home';
if( isset($get['controller']) && $get['controller'] != ''){
	$controller = $get['controller'];
}

$controller_path = ROOT_DIR . '/app/controller/' . $controller . '.php';
if (file_exists($controller_path)) {
	require $controller_path;
	$controller = ucfirst($controller);
	$app = new $controller;
} else {
	trigger_error('Error: Could not load controller ' . $controller . '!');
	exit();
}

$method = 'index';
if( isset($get['method']) && $get['method'] != ''){
	$method = $get['method'];
}
if (method_exists($app, $method)) {
	$app->{$method}();
} else {
	trigger_error('Error: Could not run action ' . $action . '!');
	exit();
}