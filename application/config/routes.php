<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

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

//Orden Servicio
$route['ordenes'] = 'C_ordenservicio';
$route['ordenservicio/nuevo'] = 'C_ordenservicio/nuevo';
$route['ordenservicio/crear'] = 'C_ordenservicio/crear';
$route['ordenservicio/(:num)/(:num)/(:num)/editar'] = function ($empresa , $sede , $id){return 'C_ordenservicio/editar/'.$empresa.'/'.$sede.'/'.$id;};
$route['ordenservicio/(:num)/(:num)/(:num)/actualizar'] = function ($empresa , $sede , $id ){return 'C_ordenservicio/actualizar/'.$empresa.'/'.$sede.'/'.$id;};
$route['ordenservicio/(:num)/(:num)/(:num)/eliminar'] = function ($empresa , $sede , $id ){return 'C_ordenservicio/eliminar/'.$empresa.'/'.$sede.'/'.$id;};

//Clientes
$route['clientes'] = 'C_cliente';
$route['cliente/nuevo'] = 'C_cliente/nuevo';
$route['cliente/crear'] = 'C_cliente/crear';
$route['cliente/(:num)/(:num)/editar'] = function ($empresa , $cliente){return 'C_cliente/editar/'.$empresa.'/'.$cliente;};
$route['cliente/(:num)/(:num)/actualizar'] = function ($empresa , $cliente){return 'C_cliente/actualizar/'.$empresa.'/'.$cliente;};
$route['cliente/(:num)/(:num)/eliminar'] = function ($empresa , $cliente){return 'C_cliente/eliminar/'.$empresa.'/'.$cliente;};

//Servicios
$route['servicios'] = 'C_servicio';
$route['servicio/nuevo'] = 'C_servicio/nuevo';
$route['servicio/crear'] = 'C_servicio/crear';
$route['servicio/(:num)/(:num)/editar'] = function ($empresa , $servicio){return 'C_servicio/editar/'.$empresa.'/'.$servicio;};
$route['servicio/(:num)/(:num)/actualizar'] = function ($empresa , $servicio){return 'C_servicio/actualizar/'.$empresa.'/'.$servicio;};
$route['servicio/(:num)/(:num)/eliminar'] = function ($empresa , $servicio){return 'C_servicio/eliminar/'.$empresa.'/'.$servicio;};

//Ubicacion
$route['usuarios'] = 'C_usuario';
$route['usuario/nuevo'] = 'C_usuario/nuevo';
$route['usuario/crear'] = 'C_usuario/crear';
$route['usuario/(:num)/editar'] = function ($id){return 'C_usuario/edit/'.$id;};
$route['usuario/(:num)/actualizar'] = function ($id){return 'C_usuario/update/'.$id;};

//Categorias
$route['categorias'] = 'C_categoria';
$route['categoria/nuevo'] = 'C_categoria/nuevo';
$route['categoria/crear'] = 'C_categoria/crear';
$route['categoria/(:num)/editar'] = function ($id){return 'C_categoria/editar/'.$id;};
$route['categoria/(:num)/actualizar'] = function ($id){return 'C_categoria/actualizar/'.$id;};
$route['categoria/(:num)/eliminar'] = function ($id){return 'C_categoria/eliminar/'.$id;};

//Visitas
$route['visitas'] = 'C_visita';
$route['visita/nuevo'] = 'C_visita/nuevo';
$route['visita/crear'] = 'C_visita/crear';
$route['visita/(:num)/(:num)/editar'] = function ($empresa , $visita){return 'C_visita/editar/'.$empresa.'/'.$visita;};
$route['visita/(:num)/(:num)/actualizar'] = function ($empresa , $visita){return 'C_visita/actualizar/'.$empresa.'/'.$visita;};
$route['visita/(:num)/(:num)/eliminar'] = function ($empresa , $visita){return 'C_visita/eliminar/'.$empresa.'/'.$visita;};

//Contactos
$route['tarifas'] = 'C_tarifario';
$route['tarifa/nuevo'] = 'C_tarifario/nuevo';
$route['tarifa/crear'] = 'C_tarifario/crear';
$route['tarifa/(:num)/(:num)/(:num)/editar'] = function ($empresa ,$cliente, $contacto){return 'C_tarifario/editar/'.$empresa.'/'.$cliente.'/'.$contacto;};
$route['tarifa/(:num)/(:num)/(:num)/actualizar'] = function ($empresa ,$cliente, $contacto){return 'C_tarifario/actualizar/'.$empresa.'/'.$cliente.'/'.$contacto;};
$route['tarifa/(:num)/(:num)/(:num)/eliminar'] = function ($empresa ,$cliente, $contacto){return 'C_tarifario/eliminar/'.$empresa.'/'.$cliente.'/'.$contacto;};
//API
$route['api/tarifa/(:num)/(:num)/(:num)/(:num)'] = function ($empresa, $sede, $cliente, $servicio){return 'C_api/tarifa/'.$empresa.'/'.$sede.'/'.$cliente.'/'.$servicio;};