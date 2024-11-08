<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/get-users'] = 'Users/get';
$route['api/create-user'] = 'Users/create';
$route['api/update-user'] = 'Users/update';
$route['api/delete-user'] = 'Users/delete';
