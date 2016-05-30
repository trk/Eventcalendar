<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['module']['eventcalendar'] = array
(
    'module' => "eventcalendar",
        'name' => "Event Calendar Module",
        'module_eventcalendar_folder' => 'Eventcalendar',
        'module_eventcalendar_addons_folder' => 'admin/eventcalendar_addons/',
        'module_eventcalendar_folder_lowercase' => 'eventcalendar',
        'module_eventcalendar_url' => admin_url() . 'module/' . 'eventcalendar' . '/',
        'module_eventcalendar_assets_folder' => base_url(). 'modules/' . 'Eventcalendar' . '/assets/',
        'module_eventcalendar_views_folder' => base_url(). 'modules/' .'Eventcalendar' . '/views/',
    'description' => "Author eventcalendar module. Manage articles's authors.<br/>This module is one Demo module, based on the tutorial available on: http://doc.ionizecms.com/en/tutorials",
    'author' => "",
    'version' => "",
   
    'uri' => 'eventcalendar',
    'has_admin'=> TRUE,
    'has_frontend'=> TRUE,
    
);
return $config['module']['eventcalendar'];
