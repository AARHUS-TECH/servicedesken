<?php
/**
 * This file is part of the ATS DataIT Servicedesk Ticketsystem package.
 *
 * @file        Redirect.php
 * @author      Benjamin Jørgensen <bj@dunkstormen.dk>
 * @copyright   AARHUS TECH DataIT Skoleoplæring 2017-2022
 * @license     MIT, please view the LICENSE file
 * 
 * @brief       Class handling config setting into globals
 */



class Redirect 
{
    public static function to( $location = null ) 
    {
        if( $location ) {
            if( is_numeric( $location ) ) 
            {
                switch( $location ) {
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        include 'includes/errors/404.php';
                        break;
                }
            }

            header('Location: '. $location);

            exit();
        }
    }
}