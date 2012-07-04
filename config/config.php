<?php 

// Module Name
$config['module_eventcalendar_name'] = 'Event Calendar Module';

// Module Folder
$config['module_eventcalendar_folder'] = 'Eventcalendar';

// Module Addons Folder
$config['module_eventcalendar_addons_folder'] = 'admin/eventcalendar_addons/';

// Module Folder Lowercase
$config['module_eventcalendar_folder_lowercase'] = strtolower($config['module_eventcalendar_folder']);

// Module URL
$config['module_eventcalendar_url'] = admin_url() . 'module/' . $config['module_eventcalendar_folder_lowercase'] . '/';

// Module Assets Folder
$config['module_eventcalendar_assets_folder'] = base_url(). 'modules/' . $config['module_eventcalendar_folder'] . '/assets/';

// Module View Folder
$config['module_eventcalendar_views_folder'] = base_url(). 'modules/' . $config['module_eventcalendar_folder'] . '/views/';