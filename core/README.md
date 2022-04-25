# Init file connection to database
Mangler init.php fil

```
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
        'dsn'       => 'mysql:host=127.0.0.1;dbname=<DBNAME>',      # Database Host
        'username'  => '<USERNAME>',                                # Database Brugernavn
        'password'  => '>PASSWORD>',                                # Database Password
        'charset'   => 'utf8'                                       # Database Charset
    ),
    'system_info' => array(
        'version'   => '1.2.0'
    ),
    'servicedesk' => array(
        'telefon'   => '<PHONENUMBER>',
        'email'     => '<EMAIL>'
    )
);

spl_autoload_register(function($class) {
    require_once $_SERVER["DOCUMENT_ROOT"] . '/classes/' . $class . '.php';
});

```
