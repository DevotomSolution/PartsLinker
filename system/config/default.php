<?php
// Site
$_['site_url']             = 'https://partslinker.com';
$_['config_name']          = 'Partslinker.com';

// Language
$_['language_code']        = 'en-gb';

// Date
$_['date_timezone']        = 'UTC';

// Database
$_['db_autostart']         = false;
$_['db_engine']            = 'mysqli'; // mysqli, pdo or pgsql
$_['db_hostname']          = 'localhost';
$_['db_username']          = 'root';
$_['db_password']          = '';
$_['db_database']          = '';
$_['db_port']              = 3306;

// Mail
$_['config_mail_engine']          = 'smtp'; // mail or smtp
$_['config_mail_from']            = 'office@partslinker.com'; // Your E-Mail
$_['config_mail_sender']          = 'Partslinker.com'; // Your name or company name
$_['config_mail_reply_to']        = ''; // Reply to E-Mail
$_['config_mail_smtp_hostname']   = 'ssl://partslinker.com';
$_['config_mail_smtp_username']   = 'office@partslinker.com';
$_['config_mail_smtp_password']   = 'b06w~18wY';
$_['config_mail_smtp_port']       = 465;
$_['config_mail_smtp_timeout']    = 5;
$_['config_mail_verp']            = false;
$_['config_mail_parameter']       = '';

// Cache
$_['cache_engine']         = 'file'; // apc, file, mem, memcached or redis
$_['cache_expire']         = 3600;

// Session
$_['session_autostart']    = false;
$_['session_engine']       = 'db'; // db or file
$_['session_name']         = 'OCSESSID';
$_['session_domain']       = '';
$_['session_path']         = !empty($_SERVER['PHP_SELF']) ? rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/' : '/';
$_['session_expire']       = 86400;
$_['session_probability']  = 1;
$_['session_divisor']      = 5;
$_['session_samesite']     = 'Strict';

// Template
$_['template_engine']      = 'twig';
$_['template_extension']   = '.twig';

// Error
$_['error_display']        = true; // You need to change this to false on a live site.
$_['error_log']            = true;
$_['error_filename']       = 'error.log';
$_['error_page']           = 'error.html';

// Response
$_['response_header']      = ['Content-Type: text/html; charset=utf-8'];
$_['response_compression'] = 0;

// Actions
$_['action_default']       = 'catalog/product';
$_['action_error']         = 'error/not_found';
$_['action_pre_action']    = [];
$_['action_post_action']   = [];
$_['action_event']         = [];

// Config
$_['config_login_attempts']			= 5;
$_['config_processing_status']		= array(1, 2, 12);
$_['config_complete_status']		= array(5, 3);
$_['config_fraud_status_id']		= 7;

$_['config_invoice_prefix']			= 'INV';
$_['config_session_expire']			= 60*60*24;