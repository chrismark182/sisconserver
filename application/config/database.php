<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '10.0.0.20',
	'username' => 'SisconUser',
	'password' => 'Siscon2020',
	'database' => 'SISCON',
	'dbdriver' => 'sqlsrv',
	'port' => '1433',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,//(ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
