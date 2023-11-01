<?php
// Site
$_['site_url']           = HTTP_SERVER;

// Database
$_['db_autostart']       = true;
$_['db_engine']          = DB_DRIVER; // mysqli, pdo or pgsql
$_['db_hostname']        = DB_HOSTNAME;
$_['db_username']        = DB_USERNAME;
$_['db_password']        = DB_PASSWORD;
$_['db_database']        = DB_DATABASE;
$_['db_port']            = DB_PORT;

// Session
$_['session_autostart']  = false;
$_['session_engine']     = 'db'; // db or file

// Actions
$_['action_pre_action']  = [
	'startup/setting',
	'startup/seo_url',
	'startup/session',
	'startup/error',
	'startup/sass',
	'startup/login',
	//'startup/authorize',
	'startup/permission',
	'startup/currency',
	'startup/api',
];

// Actions
$_['action_default'] = 'catalog/product';

// Action Events
$_['action_event']       = [
	'controller/*/before' => [
		0 => 'event/language.before'
	],
	'view/*/before' => [
		999 => 'event/language',
		1000 => 'event/theme'
	]
];
