<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    
    session_start();
    
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'shortener');
    define('DB_PREFIX', 'sh_');
    
    define('SECRET', '123456');
    define('DATE_FORMAT', 'd.m.Y H:i:s');
    
    set_include_path(get_include_path().PATH_SEPARATOR.'src');
    spl_autoload_register();
?>