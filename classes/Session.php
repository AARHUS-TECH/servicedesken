<?php
/**
 * This file is part of the ATS DataIT Servicedesk Ticketsystem package.
 *
 * @file        Session.php
 * @author      Benjamin Jørgensen <bj@dunkstormen.dk>
 * @copyright   AARHUS TECH DataIT Skoleoplæring 2017-2022
 * @license     MIT, please view the LICENSE file
 * 
 * @brief       Class handling config setting into globals
 */

class Session {
    public static function exists($name) 
    {
        return (isset($_SESSION[$name])) ? true : false;
    }


    public static function put($name, $value) 
    {
        return $_SESSION[$name] = $value;
    }


    public static function get($name) 
    {
        return $_SESSION[$name];
    }


    public static function delete($name) 
    {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    
    public static function flash ($name, $string = 'null') 
    {
        if(self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
                return $session;
        } else {
            self::put($name, $string);
        }
    }
}
