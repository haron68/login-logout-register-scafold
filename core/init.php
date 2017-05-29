<?php
session_start();

$GLOBALS['config'] = array(
    'mysql'     => array(
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => '',
        'db'        => 'roblandhrm_db'
    ),
    'remember'  => array(
        'cookie_name'   => 'hash',
        'cookie_expiry' => 604800
    ),
    'session'   => array(
        'session_name'  => 'user',
        'token_name'    => 'csrf_token'
    )
);

spl_autoload_register(function($class) {
    require_once 'classes/'. $class .'.php';
});

require_once 'functions/functions.php';