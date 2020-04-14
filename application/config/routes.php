<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'C_home';
$route['empresa/crear']='C_empresa/crear';

$route['dashboard'] = 'C_dashboard';

//Login
$route['login']='C_login';
$route['login/create'] = 'C_login/create';
$route['login/login'] = 'C_login/userpass';
$route['logout'] = 'C_login/logout';
//Menu
$route['menus'] = 'C_menu';
$route['menu/nuevo'] = 'C_menu/nuevo';
$route['menu/crear'] = 'C_menu/crear';
$route['menu/(:num)/editar'] = function ($id){return 'C_menu/editar/'.strtolower($id);};
$route['menu/(:num)/actualizar'] = function ($id){return 'C_menu/actualizar/'.strtolower($id);};

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Sedes

$route['sedes'] = 'C_sede';
$route['sede/nuevo'] = 'C_sede/nuevo';
$route['sede/crear'] = 'C_sede/crear';
$route['sede/(:num)/editar'] = function ($id){return 'C_sede/$id/editar/'.strtolower($id);};