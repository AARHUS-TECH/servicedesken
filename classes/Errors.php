<?php 
/**
 * This file is part of the ATS DataIT Servicedesk Ticketsystem package.
 *
 * @file        Error.php
 * @brief       Class handling all actions to from the database
 * @copyright   AARHUS TECH DataIT Skoleoplæring 2017-2022
 * @license     MIT, please view the LICENSE file
 * 
 * @author      Benjamin Jørgensen <bj@dunkstormen.dk>
 * @author      Karsten Reitan Sørensen <krs@aarhustech.dk>
 * @bugs        No knows bugs
 */ 

class Errors 
{

    public static function getErrorMessage($session) 
    {
        if(Session::exists($session)) {
            $message  = '<div class="row">';
            $message .= '<div class="alert alert-dismissible alert-danger full-width">';
            $message .= '<p class="text-center no-margin">' . Session::get($session) . '</p>';
            $message .= '</div>';
            $message .= '</div>';

            Session::delete($session);

            return $message;
        }

        return false;
    }


    public static function getSuccessMessage($session) 
    {
        if(Session::exists($session)) {
            $message  = '<div class="alert alert-dismissible alert-success full-width">';
            $message .= '<p class="text-center no-margin">' . Session::get($session) . '</p>';
            $message .= '</div>';

            Session::delete($session);

            return $message;
        }

        return false;
    }

}
?>