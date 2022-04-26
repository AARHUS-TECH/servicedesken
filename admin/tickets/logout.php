<?php
/**
 * This file is part of the ATS DataIT Servicedesk Ticketsystem package.
 *
 * @file        Config.php
 * @author      Benjamin Jørgensen <bj@dunkstormen.dk>
 * @copyright   AARHUS TECH DataIT Skoleoplæring 2017-2022
 * @license     MIT, please view the LICENSE file
 * 
 * @brief       Class handling config setting into globals
 */



require_once('../../core/init.php');

if (Session::exists('userID')) {
    Session::delete('userID');
    Session::flash('home_success', 'Du blev logget ud!');
	Redirect::to('/');

}

Session::delete('userID');
Redirect::to("http://servicedesken.skp");