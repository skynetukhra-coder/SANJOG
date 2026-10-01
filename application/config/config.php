<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Kolkata");
$config['base_url'] = SITE_BASE_URL;

$config['index_page'] = '';
$config['uri_protocol'] = 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language'] = 'english';
$config['charset'] = 'UTF-8';

$config['enable_hooks'] = TRUE;
$config['subclass_prefix'] = 'MY_';

$config['composer_autoload'] = FALSE;

$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

$config['allow_get_array'] = TRUE;

$config['log_threshold'] = 1;
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';

$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;

$config['encryption_key'] = 'kF8r!c92*Wvn@xQtGp6M$EyZBua3#hLp'; // 🔐 Replace with 32+ character strong key

// SESSION SECURITY
$config['sess_driver'] = 'database';
$config['sess_cookie_name'] = 'aegwbsess';        // Renamed to avoid CSRF collision
$config['sess_expiration'] = 1800;                // 30 minutes
$config['sess_save_path'] = 'agb_sessions';       // DB table
$config['sess_match_ip'] = FALSE;                 // Optional: Set TRUE if you want IP match
$config['sess_time_to_update'] = 300;             // ID regen every 5 min
$config['sess_regenerate_destroy'] = TRUE;        // Destroy old session on ID change

// COOKIE SECURITY
$config['cookie_prefix']    = 'agwb_';
$config['cookie_domain']    = (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'cag.gov.in') !== false) ? 'agwb.cag.gov.in' : '';
$config['cookie_path']      = '/';
$config['cookie_secure']    = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');               // Only send over HTTPS
$config['cookie_httponly']  = TRUE;               // JS cannot access
$config['cookie_samesite']  = 'Strict';           // CSRF protection

// CSRF PROTECTION
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'aegwbtk';
$config['csrf_cookie_name'] = 'aegwbcsrf';         // Renamed from session cookie
$config['csrf_expire'] = 1800;                     // 30 min
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

// OUTPUT
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;

$config['proxy_ips'] = '';