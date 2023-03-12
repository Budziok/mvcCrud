<?php 

error_reporting(-1); 
ini_set('display_errors', 'On');

session_start();
require("config.php");

$requestUrl = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";