<?php 

require_once "vendor/autoload.php";
//error handling
error_reporting(-1); 
ini_set('display_errors', 'On');

session_start();
require("config.php");


$requestUrl = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$bootstrap = new Bootstrap($requestUrl);

$controller = $bootstrap->createController();

if($controller)
{
    $controller->executeAction();
}