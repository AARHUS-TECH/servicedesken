<?php
/**
 * This file is part of the ATS DataIT Servicedesk Ticketsystem package.
 *
 * @file        admin/index.php
 * @author      Benjamin Jørgensen <bj@dunkstormen.dk>
 * @copyright   AARHUS TECH DataIT Skoleoplæring 2017-2022
 * @license     MIT, please view the LICENSE file
 * 
 * @brief       Admin login page an folder catch all
 */



require_once('../core/init.php');

$user = new User();

if(!Session::exists('userID')) {
    Session::flash('index_error', 'Du skal være logget ind for at kunne tilgå denne side!');
    Redirect::to('/');
}


$userdata = $user->getInfo(Session::get('userID'));

require_once("../assets/tpl/splash_header.php");

if ( $user->isAdmin(Session::get('userID')) ) 
{
?>
                                    <div class="form-group text-center">
                                        <a class="btn btn-outline-success full-width" href="/admin/bruger/">Bruger systemet</a>
                                    </div>
<?php 
}
	
require_once("../assets/tpl/splash_footer.php"); 
?>