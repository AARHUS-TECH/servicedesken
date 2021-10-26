<?php

/**
 * Beskrivelse kommer snarest
 *
 * @author      Benjamin Jørgensen <bj@dunkstormen.dk>
 * @copyright   Aarhus Tech SKP 2017
 */

session_start();

$GLOBALS['config'] = array(
    'database' => array(
        'dsn'       => 'mysql:host=127.0.0.1;dbname=skp_servicedesk',       # Database Host
        'username'  => 'skp',                                           # Database Brugernavn
        'password'  => 'SKP2017!',                                              # Database Password
        'charset'   => 'utf8'                                           # Database Charset
    ),
    'system_info' => array(
        'version'   => '1.0.2'
    ),
    'servicedesk' => array(
        'telefon'   => '22234590',
        'email'     => 'skp.it@edu.aarhustech.dk'
    )
);

spl_autoload_register(function($class) {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/classes/' . $class . '.php';
});
