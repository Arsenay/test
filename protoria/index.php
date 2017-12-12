<?php
session_start();

// Config
require_once('config.php');

// System files
require_once('system/includer.php');

// Builder
$builder = new Builder();

// Create database object
$db = new DB(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$builder->set('db', $db);

// Create loader object
$loader = new Loader($builder);
$builder->set('loader', $loader);

$controller = new ControllerHome($builder);

$controller->index();
?>