<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

$route['default_controller'] = "eventcalendar";
$route['(.*)'] = $route['default_controller'].'/$1'; 
$route[''] = $route['default_controller'].'/index';

