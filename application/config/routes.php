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
$route['sede/(:num)/(:num)/editar'] = function ($empresa,$id){return 'C_sede/editar/'.$empresa.'/'.$id;};
$route['sede/(:num)/(:num)/actualizar'] = function ($empresa,$id){return 'C_sede/actualizar/'.$empresa.'/'.$id;};
$route['sede/(:num)/(:num)/eliminar'] = function ($empresa,$id){return 'C_sede/eliminar/'.$empresa.'/'.$id;};

//Ubicacion

$route['ubicaciones'] = 'C_ubicacion';
$route['ubicacion/nuevo'] = 'C_ubicacion/nuevo';
$route['ubicacion/crear'] = 'C_ubicacion/crear';
$route['ubicacion/(:num)/(:num)/(:num)/editar'] = function ($empresa , $sede , $id){return 'C_ubicacion/editar/'.$empresa.'/'.$sede.'/'.$id;};
$route['ubicacion/(:num)/(:num)/(:num)/actualizar'] = function ($empresa , $sede , $id ){return 'C_ubicacion/actualizar/'.$empresa.'/'.$sede.'/'.$id;};
$route['ubicacion/(:num)/(:num)/(:num)/eliminar'] = function ($empresa , $sede , $id ){return 'C_ubicacion/eliminar/'.$empresa.'/'.$sede.'/'.$id;};


//Clientes

$route['clientes'] = 'C_cliente';
$route['cliente/nuevo'] = 'C_cliente/nuevo';
$route['cliente/crear'] = 'C_cliente/crear';
$route['cliente/(:num)/(:num)/editar'] = function ($empresa , $cliente){return 'C_cliente/editar/'.$empresa.'/'.$cliente;};
$route['cliente/(:num)/(:num)/actualizar'] = function ($empresa , $cliente){return 'C_cliente/actualizar/'.$empresa.'/'.$cliente;};
$route['cliente/(:num)/(:num)/eliminar'] = function ($empresa , $cliente){return 'C_cliente/eliminar/'.$empresa.'/'.$cliente;};

//Ubicacion
$route['usuarios'] = 'C_usuario';


